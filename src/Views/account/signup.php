<style>
html,
body {
    height: 100%;
}

body {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #f5f5f5;
}

.form-signin {
    width: 100%;
    max-width: 420px;
    padding: 15px;
    margin: auto;
}

.form-label-group {
    position: relative;
    margin-bottom: 1rem;
}

.form-label-group input,
.form-label-group label {
    height: 3.125rem;
    padding: .75rem;
}

.form-label-group label {
    position: absolute;
    top: 0;
    left: 0;
    display: block;
    width: 100%;
    margin-bottom: 0;
    /* Override default `<label>` margin */
    line-height: 1.5;
    color: #495057;
    pointer-events: none;
    cursor: text;
    /* Match the input under the label */
    border: 1px solid transparent;
    border-radius: .25rem;
    transition: all .1s ease-in-out;
}

.form-label-group input::-webkit-input-placeholder {
    color: transparent;
}

.form-label-group input::-moz-placeholder {
    color: transparent;
}

.form-label-group input:-ms-input-placeholder {
    color: transparent;
}

.form-label-group input::-ms-input-placeholder {
    color: transparent;
}

.form-label-group input::placeholder {
    color: transparent;
}

.form-label-group input:not(:-moz-placeholder-shown) {
    padding-top: 1.25rem;
    padding-bottom: .25rem;
}

.form-label-group input:not(:-ms-input-placeholder) {
    padding-top: 1.25rem;
    padding-bottom: .25rem;
}

.form-label-group input:not(:placeholder-shown) {
    padding-top: 1.25rem;
    padding-bottom: .25rem;
}

.form-label-group input:not(:-moz-placeholder-shown)~label {
    padding-top: .25rem;
    padding-bottom: .25rem;
    font-size: 12px;
    color: #777;
}

.form-label-group input:not(:-ms-input-placeholder)~label {
    padding-top: .25rem;
    padding-bottom: .25rem;
    font-size: 12px;
    color: #777;
}

.form-label-group input:not(:placeholder-shown)~label {
    padding-top: .25rem;
    padding-bottom: .25rem;
    font-size: 12px;
    color: #777;
}

/* Fallback for Edge
-------------------------------------------------- */
@supports (-ms-ime-align: auto) {
    .form-label-group {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column-reverse;
        flex-direction: column-reverse;
    }

    .form-label-group label {
        position: static;
    }

    .form-label-group input::-ms-input-placeholder {
        color: #777;
    }
}
</style>

<form method="POST" class="form-signin">
    <div class="text-center mb-4">
        <h1 class="h3 mb-3 font-weight-normal">Floating labels</h1>
        <p>My account</p>
    </div>

    <div class="form-label-group">
        <input type="mail" name="email" id="email" class="form-control" placeholder="Email" required autofocus>
        <label for="email">Email</label>
    </div>

    <div class="form-label-group">
        <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
        <label for="username">Username</label>
    </div>

    <div class="form-label-group">
        <input type="password" name="password" id="password" class="form-control" placeholder="password" required>
        <label for="password">Password</label>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
</form>