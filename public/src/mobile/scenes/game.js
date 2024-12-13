let width, height, mContext;
let ruleta, puntero, spinButton, bars, bglight;
// Divisiones de la ruleta
let divisiones = 6, circumference = 280;

let premios = [
    '3', '3',
    '1', '1',
    '2', '2',
];

let rotate = false;
let enablePost = true;

/* Velocidad */
let velocidad = 3;
let valocity_handler = true;
let limite;
/* --- */
/*  */
gi 
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
                mContext.rotarConstante();
                spinButton.setTexture('detenerBtn');
            }else {
                mContext.detener();
                setTimeout(() => {
                    spinButton.disableInteractive();
                }, 100);
            }

            // game.scene.keys.gameScene.rotar();
            // spinButton.disableInteractive();
        });

        spinButton.on('pointerup', function(){

        });

        spinButton.on('pointerout', () => {
            spinButton.setScale(1.1);
        });
    }

    update(){
        /* Rotacion constante */
        if (rotate){

            ruleta.angle += velocidad;

            // text.setText([
            //     'Sprite Rotation',
            //     'Angle: ' + ruleta.angle.toFixed(2),
            //     'Rotation: ' + ruleta.rotation.toFixed(2)
            // ]);
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
            elem.visible = false;
            bars.push(elem);
            cont++;
        }

        return bars;
    }

    getPremio(){
        // Hace rotar las barras al ángulo del a ruleta (RotateAroundDistance funciona con radianes)
        Phaser.Actions.RotateAroundDistance(bars, { x: (width/2), y: (height/2) + 75 }, ruleta.rotation, circumference);
        /*
            El comportamiento normal del evento es ser ejecutado todo el tiempo mientrras este se cumpla.
            Con esto logro ejecutarlo solo una vez.
        */
        bars.forEach((elem) => {
            this.physics.add.collider(elem, puntero, function(bar = elem){
                bar.disableBody(true, true);
                setTimeout(() => {
                    if (enablePost){
                        enablePost = false;
                        axios.post('/storePremio', {
                            premio: bar.premio
                        })
                        .then(function (response) {
                            let data = response.data;
                            if (data.status === 'success'){
                                mContext.popUp(bar.premio);
                            }else if (data.status === 255){
                                alert(data.message);
                                location.reload();
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    }
                }, 500);
            });
        });
    }

    rotar(){
        ruleta.rotation = 0;
        velocidad = 1;
        rotate = !rotate;
        // Veolicdad aleatoria
        limite = this.getRndInteger(15, 30);
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

        // let background = this.add.image((width/2), (height/2), 'background').setScale(1);
        let logo = this.add.image((width/2), (height/2) - 450, 'logo').setScale(1.3);
        let base = this.add.image((width/2), (height/2) + 475, 'base');

        ruleta = this.add.sprite((width/2), (height/2) + 75, 'ruleta');
        let luces = this.add.sprite((width/2) - 3, (height/2) + 68, 'luces');
        puntero = this.physics.add.sprite((width/2), (height/3), 'puntero').setScale(.8);
        puntero.setSize(true, 100, 120);
        spinButton = this.physics.add.sprite((width/2), (height/2) + 76, 'girarBtn').setScale(1.1).setInteractive();

        bars = this.setBars(divisiones, this);
        const circle = new Phaser.Geom.Circle((width/2), (height/2) + 75, circumference);
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
        mContext.add.image((width/2), (height/2), 'bg-pop').setScale(1);
        mContext.add.image((width/2), (height/2), `bgp-${premio}`).setScale(1);
        bglight = mContext.add.image((width/2), (height/2), 'bg-light').setScale(1);
        mContext.add.image((width/2) + 20, (height/2) - 40, `p-${premio}`).setScale(1);
        setTimeout(() => {
            location.reload();
        }, 8000);
    }
}
