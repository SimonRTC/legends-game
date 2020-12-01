<?php

namespace Migrations;

class Databases {

    private $Kernel;
    private $args;
    private $Databases;

    public function __construct(\Console\Kernel &$Kernel, array $args) {
        $this->Kernel       = $Kernel;
        $this->args         = $args;
        $this->Databases    = \json_decode(\file_get_contents( __PATH__ . "/src/conf/databases.json"), false);
        $this->Database     = new \LegendsGame\Database("default");
    }
    
    /**
     * Import tables structure & datas
     *
     * @return void
     */
    public function push(): void {
        $tables = (!empty($this->args["tables"])? explode(",", $this->args["tables"]): []);
        $import = (!empty($this->args["import"])? $this->args["import"]: null);
        $rebase = (empty($tables)? $this->Kernel->AskYesOrNoQuestion("Without selecting any table(s) [with --tables] you will overwrite the exported data set."): true);
        if ($rebase) {
            if (empty($import) || $import == "structure") {
                $structure = $this->ImportTablesStructure($tables);
                $this->Kernel->Trace(($structure? "SUCCESS": "DANGER"), ($structure? "The table(s) structure has been successfully imported.": "An error occurred while importation table(s) structure."));
            }
            if (empty($import) || $import == "datas") {
                $datas = $this->ImportTablesDatas($tables);
                $this->Kernel->Trace(($datas? "SUCCESS": "DANGER"), ($datas? "The table(s) datas has been successfully imported.": "An error occurred while importation table(s) datas."));
            }
        }

    }

    /**
     * Export tables structure & datas
     *
     * @return void
     */
    public function pull(): void {
        $tables = (!empty($this->args["tables"])? explode(",", $this->args["tables"]): []);
        $export = (!empty($this->args["export"])? $this->args["export"]: null);
        $rebase = (empty($tables)? $this->Kernel->AskYesOrNoQuestion("Without selecting any table(s) [with --tables] you will overwrite the exported data set."): true);
        if ($rebase) {
            if (empty($export) || $export == "structure") {
                $structure = $this->ExportTablesStructure($tables);
                $structure = $this->SaveExportedContent("{PATH}/migrations/structures.json", $structure, (empty($tables)? true: false));
                $this->Kernel->Trace(($structure? "SUCCESS": "DANGER"), ($structure? "The table(s) structure has been successfully exported.": "An error occurred while exporting table(s) structure."));
            }
            if (empty($export) || $export == "datas") {
                $datas = $this->ExportTablesDatas($tables);
                $datas = $this->SaveExportedContent("{PATH}/migrations/datas.json", $datas, (empty($tables)? true: false));
                $this->Kernel->Trace(($datas? "SUCCESS": "DANGER"), ($datas? "The data in the table(s) has been successfully exported.": "An error occurred while exporting table(s) datas."));
            }
        }

    }

    /**
     * Export tables datas
     *
     * @param  array $tables
     * @return array
     */
    private function ImportTablesDatas($tables = []): bool {
        $datas = __PATH__ ."/migrations/datas.json";
        $datas = (file_exists($datas)? json_decode(file_get_contents($datas), false): []);
        if (!empty($datas)) {
            foreach ($this->Databases as $database => $_datas_) {
                if ($this->Database->dbname != $database) {
                    $this->Database->Switch($database);
                }
                $_tables = $this->ShowTables();
                foreach ($_tables as $table) {
                    if (empty($tables) || in_array($table, $tables)) {
                        if (isset($datas->{$table}) && !empty($datas->{$table})) {
                            $column = $datas->{$table};
                            if (!empty($column[0])) {
                                $SQL    = "INSERT INTO `{$table}` (";
                                $entry  = null;
                                foreach ($column[0] as $row => $value) {
                                    $entry .= " `{$row}`,";
                                }
                                $entry  = trim(trim($entry, ","));
                                $SQL    .= "{$entry}) VALUES ";
                                $entry  = null;
                                foreach ($column as $row => $value) {
                                    $entry .= "(";
                                    foreach ($value as $val) {
                                        $val    = str_replace("\"", "\\\"", $val);
                                        $entry .= "\"" . ($val === null? "NULL": $val) . "\",";
                                    }
                                    $entry = trim(trim($entry, ", "));
                                    $entry .= "), ";
                                }
                                $entry = trim(trim($entry, ", "));
                                $SQL .= "$entry;";
                                $resp   = $this->Database->Request($SQL);
                                $resp   = $resp->errorInfo();
                                $resp   = (isset($resp[2]) && !empty($resp[2])? $resp[2]: null);
                                $this->Kernel->Trace((empty($resp)? "INFO": "WARNING"), (empty($resp)? "The \"{$table}\" table was successfully injected.": "Unable to injected the \"{$table}\" table (SQL ERROR: \"{$resp}\")."));
                            }
                        }
                    }
                }
            }
            return true;
        }
        return false;
    }

    /**
     * Export tables structure
     *
     * @param  array $tables
     * @return array
     */
    private function ImportTablesStructure($tables = []): bool {
        $structures = __PATH__ ."/migrations/structures.json";
        $structures = (file_exists($structures)? json_decode(file_get_contents($structures), false): []);
        if (!empty($structures)) {
            foreach ($structures as $database => $structure) {
                if ($this->Database->dbname != $database) {
                    $this->Database->Switch($database);
                }
                foreach ($structure as $table => $column) {    
                    if (empty($tables) || in_array($table, $tables)) {        
                        $this->Database->Request("DROP TABLE IF EXISTS `{$table}`;");
                        $SQL    = "CREATE TABLE `{$table}` (";
                        $entry  = null;
                        foreach ($column as $row) {
                            $row->nullable  = ($row->nullable === "NO"? "NOT NULL": "NULL");
                            $row->collation = (!empty($row->collation)? "COLLATE {$row->collation}": null);
                            $entry .= " `{$row->name}` {$row->type} {$row->collation} {$row->nullable},";
                        }
                        $entry      = trim(trim($entry, ","));
                        $primary    = null;
                        foreach ($column as $row) {
                            if ($row->primary === true) {
                                $primary = ", PRIMARY KEY (`{$row->name}`)";
                                break;
                            }
                        }
                        $SQL    .= "{$entry}{$primary});";
                        $resp   = $this->Database->Request($SQL);
                        $resp   = $resp->errorInfo();
                        $resp   = (isset($resp[2]) && !empty($resp[2])? $resp[2]: null);
                        $this->Kernel->Trace((empty($resp)? "INFO": "WARNING"), (empty($resp)? "The \"{$table}\" table was successfully created.": "Unable to generate the \"{$table}\" table (SQL ERROR: \"{$resp}\")."));
                    }
                }
            }
        }
        return (!empty($structures)? true: false);
    }

    /**
     * Export tables structure
     *
     * @param  array $tables
     * @return array
     */
    private function ExportTablesStructure($tables = []): array {
        $columns = [];
        foreach ($this->Databases as $database => $datas) {
            if ($this->Database->dbname != $database) {
                $this->Database->Switch($database);
            }
            $_tables = $this->ShowTables();
            foreach ($_tables as $_table) {
                if (empty($tables) || in_array($_table, $tables)) {
                    $rows       = $this->Database->Request("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :tablename", [ "tablename" => $_table ])->fetchAll();
                    $primary    = $this->Database->Request("SHOW KEYS FROM `{$_table}` WHERE Key_name = 'PRIMARY';")->fetch();
                    $primary    = (isset($primary["Column_name"]) && !empty($primary["Column_name"])? $primary["Column_name"]: null);
                    if (!empty($rows)) {
                        $this->Kernel->Trace("INFO", "Updating the \"{$_table}\" table structure.");
                        foreach ($rows as $i => $row) {
                            $columns[$this->Database->dbname][$_table][$row["COLUMN_NAME"]] = [
                                "name"      => $row["COLUMN_NAME"],
                                "primary"   => ($primary == $row["COLUMN_NAME"]? true: false),
                                "type"      => $row["COLUMN_TYPE"],
                                "default"   => (isset($row["COLUMN_DEFAULT"])? $row["COLUMN_DEFAULT"]: false),
                                "nullable"  => $row["IS_NULLABLE"],
                                "character" => $row["CHARACTER_SET_NAME"],
                                "collation" => $row["COLLATION_NAME"],
                            ];
                        }
                    } else {
                        $this->Kernel->Trace("WARNING", "An error occurred while retrieving the \"{$_table}\" table structure.");
                    }
                }
            }
        }
        return $columns;
    }
    
    /**
     * Export tables datas
     *
     * @param  array $tables
     * @return array
     */
    private function ExportTablesDatas($tables = []): array {
        $columns = [];
        foreach ($this->Databases as $database => $datas) {
            if ($this->Database->dbname != $database) {
                $this->Database->Switch($database);
            }
            $_tables = $this->ShowTables();
            foreach ($_tables as $_table) {
                if (empty($tables) || in_array($_table, $tables)) {
                    $rows = $this->Database->Request("SELECT * FROM `{$_table}`", [ "tablename" => $_table ])->fetchAll();
                    if (!empty($rows)) {
                        $this->Kernel->Trace("INFO", "Updating the \"{$_table}\" table datas.");
                        foreach ($rows as &$row) {
                            foreach ($row as $column => $entry) {
                                if (!is_string($column)) {
                                    unset($row[$column]);
                                }
                            }
                        }
                    } else {
                        $this->Kernel->Trace("WARNING", "An error occurred while retrieving the \"{$_table}\" table datas.");
                    }
                    $columns[$_table] = $rows;
                }
            }
        }
        return $columns;
    }
    
    /**
     * Show all tables in databases
     *
     * @return array
     */
    private function ShowTables(): array {
        $tables = $this->Database->Request("SHOW TABLES;")->fetchAll();
        foreach ($tables as &$table) {
            $table = array_values($table);
            if (isset($table[1]) && !empty($table[1])) {
                $table = $table[1];
            } else {
                unset($table);
            }
        }
        return $tables;
    }
    
    /**
     * Rebase export file
     *
     * @param  string $path
     * @param  array $content
     * @param  bool $erase
     * @return bool
     */
    private function SaveExportedContent(string $path, array $content, bool $erase): bool {
        $path = str_replace("{PATH}", __PATH__, $path);
        if (!$erase && file_exists($path)) {
            $_content   = file_get_contents($path);
            $_content   = json_decode($_content, true);
            $content    = (!empty($_content)? array_merge($content, $_content): $content);
        }
        return file_put_contents($path, json_encode($content));
    }

}

?>