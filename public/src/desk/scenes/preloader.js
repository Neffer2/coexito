export class Preloader extends Phaser.Scene {
    constructor ()
    {
        super('Preloader');
    }

    preload ()
    {
        this.load.setPath('../../assets/ruleta/desk');
        this.load.image('background', 'bg.jpg');
        this.load.image('bg-pop', 'bg-pop.png');
        this.load.image('bg-light', 'bg-light.png');
        this.load.image('bgp-1', 'bgp-1.png');
        this.load.image('bgp-2', 'bgp-2.png');
        this.load.image('bgp-3', 'bgp-3.png');
        this.load.image('p-1', 'p-1.png');
        this.load.image('p-2', 'p-2.png');
        this.load.image('p-3', 'p-3.png');
        this.load.image('logo', 'logo.png');
        this.load.image('puntero', 'puntero.png');
        this.load.image('ruleta', 'ruleta.png');
        this.load.image('base', 'base.png');
        this.load.image('girarBtn', 'button.png');
        this.load.image('detenerBtn', 'button-stop.png');
        this.load.image('bg-cj', 'bg_cj.png');
        this.load.image('cjv1', 'cjv1_.png');
        this.load.image('cj_logo', 'cj_logo.png');
        this.load.image('x-cj', 'x-cj.png');
        this.load.image('continuar', 'continuar_btn.png');
        this.load.spritesheet('luces', 'luces-spritesheet.png', { frameWidth: 797.5, frameHeight: 792 });

        let rect2 = this.make.graphics().fillStyle(0xFFFFFF).fillRect(50, 50, 150, 25);
        rect2.generateTexture('rectangle', 340, 25);
    }

    create ()
    {
        this.scene.start('Tutorial');
    }
}
