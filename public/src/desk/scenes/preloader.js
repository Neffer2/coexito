export class Preloader extends Phaser.Scene {
    constructor ()
    {
        super('Preloader');
    }

    preload ()
    {
        this.load.setPath('../../assets/ruleta/desk');
        this.load.image('background', 'bg.png');
        this.load.image('bg-light-ruleta', '/lights.png');
        this.load.image('logo', 'logo-coexito.png');
        this.load.image('coljuegos', 'logo-coljuegos.png');
        this.load.image('bg-light', 'bg-light.png');
        this.load.image('puntero', 'puntero.png');
        this.load.image('ruleta', 'ruleta.png');
        this.load.image('base', 'base.png');
        this.load.image('copy1', 'copy1.png');
        this.load.image('copy2', 'copy2.png');
        this.load.image('girarBtn', 'button.png');
        this.load.image('x-cj', 'x-cj.png');
        this.load.spritesheet('luces', 'luces-spritesheet.png', { frameWidth: 662, frameHeight: 662 });

        // PopUp
        this.load.image('bg-pop', '/popup/bg-pop.png');
        this.load.image('bg-light', '/popup/bg-light.png');
        this.load.image('20mil', '/popup/20mil.png');
        this.load.image('30mil', '/popup/30mil.png');
        this.load.image('50mil', '/popup/50mil.png');
        this.load.image('100mil', '/popup/100mil.png');
        this.load.image('sigue-intentando', '/popup/sigue_intentando.png');
        this.load.audio('win-sound', '/sound/tada.mp3');

        let rect2 = this.make.graphics().fillStyle(0xFFFFFF).fillRect(50, 50, 150, 25);
        rect2.generateTexture('rectangle', 40, 25);
    }

    create ()
    {
        this.scene.start('Game');
    }
}
