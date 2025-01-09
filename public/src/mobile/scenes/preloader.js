export class Preloader extends Phaser.Scene {
    constructor ()
    {
        super('Preloader');
    }

    preload ()
    {
        this.load.setPath('../../assets/ruleta/mobile');
        this.load.image('background', 'bg.png');
        this.load.image('bg-light', 'bg-light.png');
        this.load.image('puntero', 'puntero.png');
        this.load.image('ruleta', 'ruleta.png');
        this.load.image('girarBtn', 'button.png');
        this.load.image('x-cj', 'x-cj.png');
        this.load.spritesheet('luces', 'luces-spritesheet.png', { frameWidth: 662, frameHeight: 662 });

        let rect2 = this.make.graphics().fillStyle(0xFFFFFF).fillRect(50, 50, 150, 25);
        rect2.generateTexture('rectangle', 84, 25);
    }

    create ()
    {
        this.scene.start('Game');
    }
}
