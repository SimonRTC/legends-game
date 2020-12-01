var canvas = document.getElementById("g-main"),
    ctx = canvas.getContext("2d"),
    container = document.getElementById("g-container");

InitializationOfGameCore();

window.addEventListener('resize', InitializationOfGameCore);

function InitializationOfGameCore() {
    canvas.width    = container.clientWidth;
    canvas.height   = container.clientHeight;

    let blips = [
        {
            label: "Hello World!",
            image: "https://wiki.gtanet.work/images/thumb/2/2c/blip_491.png/30px-blip_491.png",
            posistion: {
                x: 130,
                y: 135
            }
        },
        /*
        {
            label: "Hello World!",
            image: "https://wiki.gtanet.work/images/thumb/c/c7/blip_84.png/30px-blip_84.png",
            posistion: {
                x: 150,
                y: 80
            }
        },
        {
            label: "Hello World!",
            image: "https://wiki.gtanet.work/images/thumb/6/6a/blip_140.png/30px-blip_140.png",
            posistion: {
                x: 900,
                y: 900
            }
        },
        {
            label: "Hello World!",
            image: "https://wiki.gtanet.work/images/thumb/6/61/blip_350.png/30px-blip_350.png",
            posistion: {
                x: 80,
                y: 150
            }
        },
        {
            label: "Hello World!",
            image: "https://wiki.gtanet.work/images/thumb/9/99/blip_273.png/30px-blip_273.png",
            posistion: {
                x: 1040,
                y: 230
            }
        }
        */
    ];

    var background = new Image();
    background.src = "/assets/img/maps/main-maps.jpg";

    background.onload = function(){
        drawImageProp(ctx, background, 0, 0, canvas.width, canvas.height, 0, 0);
        blips.forEach((blip, i) => {
            blip.index = i;
            depict(blip);
        });
    }

    const depict = blip => {
        return loadImage(blip.image).then(img => {
            blip.posistion              = GetRealCoords(blip.posistion);
            blips[blip.index].posistion = blip.posistion;
            drawImageProp(ctx, img, blip.posistion.x, blip.posistion.y, img.width, img.height, 0, 0);
        });
    };

    const loadImage = url => {
        return new Promise((resolve, reject) => {
          const img = new Image();
          img.onload = () => resolve(img);
          img.onerror = () => reject(new Error(`load ${url} fail`));
          img.src = url;
        });
    };
}

function GetRealCoords(pos) {

    let torqueX = (pos.x * (canvas.width != 1920? canvas.width / 1920: 1)),
        torqueY = (pos.y * (canvas.height != 700? canvas.height / 700: 1));

    pos.x = torqueX;
    pos.y = torqueY;

    return pos;
}

function drawImageProp(ctx, img, x, y, w, h, offsetX, offsetY) {

    if (arguments.length === 2) {
        x = y = 0;
        w = ctx.canvas.width;
        h = ctx.canvas.height;
    }

    offsetX = typeof offsetX === "number" ? offsetX : 0.5;
    offsetY = typeof offsetY === "number" ? offsetY : 0.5;

    if (offsetX < 0) offsetX = 0;
    if (offsetY < 0) offsetY = 0;
    if (offsetX > 1) offsetX = 1;
    if (offsetY > 1) offsetY = 1;

    var iw = img.width,
        ih = img.height,
        r = Math.min(w / iw, h / ih),
        nw = iw * r,
        nh = ih * r,
        cx, cy, cw, ch, ar = 1;
 
    if (nw < w) ar = w / nw;                             
    if (Math.abs(ar - 1) < 1e-14 && nh < h) ar = h / nh;
    nw *= ar;
    nh *= ar;

    cw = iw / (nw / w);
    ch = ih / (nh / h);

    cx = (iw - cw) * offsetX;
    cy = (ih - ch) * offsetY;

    if (cx < 0) cx = 0;
    if (cy < 0) cy = 0;
    if (cw > iw) cw = iw;
    if (ch > ih) ch = ih;

    ctx.drawImage(img, cx, cy, cw, ch,  x, y, w, h);
}