let width, height, mContext;
let ruleta, puntero, spinButton, bars, bglight;
// Divisiones de la ruleta
let divisiones = 6, circumference = 340;

let premios = [
    '3', '3',
    '1', '1',
    '2', '2',
];

let rotate = false;
let enablePost = true;
/* Velocidad */
let velocidad = 5;
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
            spinButton.setScale(1.3);
            if (!rotate){
                mContext.rotar();
            }else {
                mContext.detener();
                setTimeout(() => {
                    spinButton.disableInteractive();
                }, 100);
            }
        });

        spinButton.on('pointerup', function(){

        });

        spinButton.on('pointerout', () => {
            spinButton.setScale(1.2);
        });
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
            elem.visible = false;
            bars.push(elem);
            cont++;
        }

        return bars;
    }

    getPremio(){
        // Hace rotar las barras al ángulo del a ruleta (RotateAroundDistance funciona con radianes)
        Phaser.Actions.RotateAroundDistance(bars, { x: (width/2), y: (height/2) - 50 }, ruleta.rotation, circumference);
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

        // let background = this.add.image((width/2), (height/2), 'background').setScale(1);
        let logo = this.add.image((width/12), (width/12), 'logo').setScale(1.5);
        let base = this.add.image((width/2), (height/2) + 415, 'base');

        ruleta = this.add.sprite((width/2), (height/2) - 45, 'ruleta');
        let luces = this.add.sprite((width/2) - 3, (height/2) - 50, 'luces');
        puntero = this.physics.add.sprite((width/2), (height/7) - 10, 'puntero');
        puntero.setSize(true, 100, 140);
        spinButton = this.physics.add.sprite((width/2), (height/2) - 45, 'girarBtn').setScale(1.2).setInteractive();

        bars = this.setBars(divisiones, this);
        const circle = new Phaser.Geom.Circle((width/2), (height/2) - 50, circumference);
        Phaser.Actions.PlaceOnCircle(bars, circle, 0);

        this.anims.create({
            key: 'casino-lights',
            frames: this.anims.generateFrameNumbers('luces', { start: 0, end: 1 }),
            frameRate: 5,
            repeat: -1
        });
        luces.anims.play('casino-lights', true);
    }

    popUp(premio){
        mContext.add.image((width/2), (height/2), 'bg-pop').setScale(1);
        mContext.add.image((width/2), (height/2), `bgp-${premio}`).setScale(1);
        bglight = mContext.add.image((width/2), (height/2), 'bg-light').setScale(1);
        mContext.add.image((width/2) + 20, (height/2) - 50, `p-${premio}`).setScale(1);
        setTimeout(() => {
            location.reload();
        }, 8000);
    }
}
