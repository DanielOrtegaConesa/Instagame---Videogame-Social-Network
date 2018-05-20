
var pelota;
var base;
var ladrillos;

var pelotaEnBase = true;
var vidas = 3;
var puntuacion = 0;

var textoPuntuacion;
var textoVidas;
var textoIntro;

var s;
var game = new Phaser.Game(800, 600, Phaser.AUTO, 'juego', { preload: preload, create: create, update: update });

function preload() {
    game.load.atlas('breakout', '/public/Juego/img/breakout.png', '/public/Juego/mapa.json');
    game.load.image('fondo', '/public/Juego/img/fondo.png');
}

function create() {
    game.physics.startSystem(Phaser.Physics.ARCADE);

    game.physics.arcade.checkCollision.down = false;
    s = game.add.tileSprite(0, 0, 800, 600, 'fondo');
    ladrillos = game.add.group();
    ladrillos.enableBody = true;
    ladrillos.physicsBodyType = Phaser.Physics.ARCADE;

    var ladrillo;

    for (var y = 0; y < 4; y++)
    {
        for (var x = 0; x < 15; x++)
        {
            ladrillo = ladrillos.create(120 + (x * 36), 100 + (y * 52), 'breakout', 'brick_' + (y+1) + '_1.png');
            ladrillo.body.bounce.set(1);
            ladrillo.body.immovable = true;
        }
    }

    base = game.add.sprite(game.world.centerX, 500, 'breakout', 'paddle_big.png');
    base.anchor.setTo(0.5, 0.5);

    game.physics.enable(base, Phaser.Physics.ARCADE);

    base.body.collideWorldBounds = true;
    base.body.bounce.set(1);
    base.body.immovable = true;

    pelota = game.add.sprite(game.world.centerX, base.y - 16, 'breakout', 'ball_1.png');
    pelota.anchor.set(0.5);
    pelota.checkWorldBounds = true;

    game.physics.enable(pelota, Phaser.Physics.ARCADE);

    pelota.body.collideWorldBounds = true;
    pelota.body.bounce.set(1);

    pelota.animations.add('spin', [ 'ball_1.png', 'ball_2.png', 'ball_3.png', 'ball_4.png', 'ball_5.png' ], 50, true, false);

    pelota.events.onOutOfBounds.add(pelotaPerdida, this);

    textoPuntuacion = game.add.text(32, 550, 'puntuacion: 0', { font: "20px Arial", fill: "#000000", align: "left" });
    textoVidas = game.add.text(680, 550, 'vidas: 3', { font: "20px Arial", fill: "#000000", align: "left" });
    textoIntro = game.add.text(game.world.centerX, 400, '- Click Para Empezar -', { font: "40px Arial", fill: "#000000", align: "center" });
    textoIntro.anchor.setTo(0.5, 0.5);

    game.input.onDown.add(lanzarPelota, this);

}

function update () {

    //  Fun, but a little sea-sick inducing :) Uncomment if you like!
    // s.tilePosition.x += (game.input.speed.x / 2);
    base.x = game.input.x;

    if (base.x < 24)
    {
        base.x = 24;
    }
    else if (base.x > game.width - 24)
    {
        base.x = game.width - 24;
    }

    if (pelotaEnBase)
    {
        pelota.body.x = base.x;
    }
    else
    {
        game.physics.arcade.collide(pelota, base, bolaGolpeaBase, null, this);
        game.physics.arcade.collide(pelota, ladrillos, bolaGolpeaLadrillo, null, this);
    }

}

function lanzarPelota () {

    if (pelotaEnBase)
    {
        pelotaEnBase = false;
        pelota.body.velocity.y = -300;
        pelota.body.velocity.x = -75;
        pelota.animations.play('spin');
        textoIntro.visible = false;
    }

}

function pelotaPerdida () {

    vidas--;
    textoVidas.text = 'vidas: ' + vidas;

    if (vidas === 0)
    {
        juegoFinalizado();
    }
    else
    {
        pelotaEnBase = true;

        pelota.reset(base.body.x + 16, base.y - 16);

        pelota.animations.stop();
    }

}

function juegoFinalizado () {

    pelota.body.velocity.setTo(0, 0);

    textoIntro.text = 'Juego Finalizado';
    textoIntro.visible = true;

}

function bolaGolpeaLadrillo (_ball, _brick) {

    _brick.kill();

    puntuacion += 10;

    textoPuntuacion.text = 'puntuacion: ' + puntuacion;

    //  Are they any ladrillos left?
    if (ladrillos.countLiving() == 0)
    {
        //  New level starts
        puntuacion += 1000;
        textoPuntuacion.text = 'puntuacion: ' + puntuacion;
        textoIntro.text = '- Proximo Nivel -';

        //  Let's move the pelota back to the base
        pelotaEnBase = true;
        pelota.body.velocity.set(0);
        pelota.x = base.x + 16;
        pelota.y = base.y - 16;
        pelota.animations.stop();

        //  And bring the ladrillos back from the dead :)
        ladrillos.callAll('revive');
    }

}

function bolaGolpeaBase (_ball, _paddle) {

    var diff = 0;

    if (_ball.x < _paddle.x)
    {
        //  Ball is on the left-hand side of the base
        diff = _paddle.x - _ball.x;
        _ball.body.velocity.x = (-10 * diff);
    }
    else if (_ball.x > _paddle.x)
    {
        //  Ball is on the right-hand side of the base
        diff = _ball.x -_paddle.x;
        _ball.body.velocity.x = (10 * diff);
    }
    else
    {
        //  Ball is perfectly in the middle
        //  Add a little random X to stop it bouncing straight up!
        _ball.body.velocity.x = 2 + Math.random() * 8;
    }

}
