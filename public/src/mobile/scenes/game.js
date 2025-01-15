let width, height, mContext;
let ruleta, puntero, spinButton, tempButton, bars, bglight;
// Divisiones de la ruleta
let divisiones = 20, circumference = 260;

let premios = [
    {'arte': '50mil', 'codigo': 103},
    {'arte': 'sigue-intentando', 'codigo': 555},
    {'arte': 'sigue-intentando', 'codigo': 555},
    {'arte': 'sigue-intentando', 'codigo': 555},
    {'arte': 'sigue-intentando', 'codigo': 555},
    {'arte': '30mil', 'codigo': 102},
    {'arte': 'sigue-intentando', 'codigo': 555},
    {'arte': 'sigue-intentando', 'codigo': 555},
    {'arte': 'sigue-intentando', 'codigo': 555},
    {'arte': 'sigue-intentando', 'codigo': 555},
    {'arte': '100mil', 'codigo': 104},
    {'arte': 'sigue-intentando', 'codigo': 555},
    {'arte': 'sigue-intentando', 'codigo': 555},
    {'arte': 'sigue-intentando', 'codigo': 555},
    {'arte': 'sigue-intentando', 'codigo': 555},
    {'arte': '20mil', 'codigo': 101},
    {'arte': 'sigue-intentando', 'codigo': 555},
    {'arte': 'sigue-intentando', 'codigo': 555},
    {'arte': 'sigue-intentando', 'codigo': 555},
    {'arte': 'sigue-intentando', 'codigo': 555},
];

let rotate = false;
let enablePost = true;

/* Velocidad */
let velocidad = 10;
let valocity_handler = true;
let limite;
/* --- */
/*  */

export class Game extends Phaser.Scene {
    constructor ()
    {
        super('Game');
    }

    create(){
        mContext = this;

        spinButton.on('pointerdown', function (pointer)
        {
            spinButton.setScale(1.2);
            if (!rotate){
                mContext.rotar();
                setTimeout(() => {
                    spinButton.disableInteractive();
                }, 500);
            }
        });

        spinButton.on('pointerup', function(){

        });

        spinButton.on('pointerout', () => {
            spinButton.setScale(1);
        });

        // bars.forEach((elem) => {
        //     elem.on('pointerdown', function (pointer){
        //         alert(elem.premio);
        //     });
        // });

    }

    update(){
        /* Rotacion constante */
        if (rotate){
            /*
                Aumenta la velocidada cada PASO.
                Hasta el límmite.
                Luego resta la velocidad hasta cero.
             */
            if (valocity_handler && velocidad > limite){
                valocity_handler = !valocity_handler;
            }

            if (valocity_handler && !(velocidad == 0)){
                velocidad += 1;
            }

            if (!valocity_handler && !(velocidad <= 0)){
                velocidad -= .1;
            }
            ruleta.angle += velocidad;

            if (velocidad < 0){
                rotate = !rotate;
                valocity_handler = !valocity_handler;
                puntero.setAngle(0);
                this.getPremio();
            }
        }

        if (bglight){bglight.angle += 0.5;}
    }

    /*
        Crea un arreglo con elementos
        - Inserta el nombre del premio
        - Los elementos se ordenan en el circulo de arriba hacia abajo,
            De derecha a izquierda
    */
    setBars(divisiones, context){
        let cont = 0;
        let bars = [];
        let elem;
        while(cont < divisiones){
            elem = context.physics.add.sprite(0, 0, 'rectangle');
            elem.premio = premios[cont];
            // elem.visible = false;
            // elem.setInteractive();
            bars.push(elem);
            cont++;
        }

        return bars;
    }

    getPremio(){
        // Hace rotar las barras al ángulo del a ruleta (RotateAroundDistance funciona con radianes)
        Phaser.Actions.RotateAroundDistance(bars, { x: (width/2), y: (height/2)}, ruleta.rotation, circumference);
        /*
            El comportamiento normal del evento es ser ejecutado todo el tiempo mientras este se cumpla.
            Con esto logro ejecutarlo solo una vez.
        */
        bars.forEach((elem) => {
            this.physics.add.collider(elem, puntero, function(bar = elem){
                bar.disableBody(true, true);
                puntero.disableBody(true, true);
                if (bar.premio){
                    setTimeout(() => {
                        mContext.popUp(bar.premio.arte);
                    }, 1000);
                    setTimeout(() => {
                        if (enablePost){
                            enablePost = false;
                            axios.post('/store-premio', {
                                premio: bar.premio.codigo
                            })
                            .then(function (response) {
                                let data = response.data;
                                if (data.status === 200){

                                }else {
                                    alert("Opps, algo salió mal, inténtalo de nuevo mas tarde.");
                                    location.reload();
                                }
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                        }
                    }, 500);
                }else {
                    location.reload();
                }
            });
        });
    }

    rotar(){
        ruleta.rotation = 0;
        velocidad = 1;
        rotate = !rotate;
        // Veolicdad aleatoria
        limite = this.getRndInteger(15, 50);
    }

    // Rotar cosntante (cambios claro)
    rotarConstante(){
        ruleta.rotation = 0;
        rotate = !rotate;
        limite = 1000;
    }

    detener(){
        rotate = !rotate;
        puntero.setAngle(0);
        this.getPremio();
    }

    getRndInteger(min, max) {
        return Math.floor(Math.random() * (max - min)) + min;
    }

    init(){
        width = this.game.config.width;
        height = this.game.config.height;

        let base = this.add.image((width/2), (height - 280), 'base');
        let logo = this.add.image((width/2), 110, 'logo');
        let coljuegos = this.add.image((width) - 100, 40, 'coljuegos');

        let luces = this.add.sprite((width/2), (height/2) - 1.5, 'luces');
        ruleta = this.add.sprite((width/2), (height/2), 'ruleta');

        puntero = this.physics.add.sprite((width/2), (height/4) + 70, 'puntero');
        puntero.setSize(true, 80, 10);
        spinButton = this.physics.add.sprite((width/2), (height - 110), 'girarBtn').setScale(1).setInteractive();

        bars = this.setBars(divisiones, this);
        const circle = new Phaser.Geom.Circle((width/2), (height/2), circumference);
        Phaser.Actions.PlaceOnCircle(bars, circle, 0);

        this.anims.create({
            key: 'casino-lights',
            frames: this.anims.generateFrameNumbers('luces', { start: 0, end: 1 }),
            frameRate: 7,
            repeat: -1
        });
        luces.anims.play('casino-lights', true);
    }

    popUp(premio){
        // mContext.add.image((width/2), (height/2), 'bg-pop').setScale(1);
        bglight = mContext.add.image((width/2), (height/2), 'bg-light').setScale(2);
        mContext.add.image((width/2), (height/2), premio).setScale(1);
        setTimeout(() => {
            location.reload();
        }, 8000);
    }
}
