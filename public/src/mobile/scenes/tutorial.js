let width, height, mContext;

export class Tutorial extends Phaser.Scene {
    constructor ()
    {
        super('Tutorial');
    }

    preload ()
    {

    }

    create ()
    {
        width = this.game.config.width;
        height = this.game.config.height;
        mContext = this;

        mContext.add.image((width/2), (height/2), 'bg-pop').setScale(1);
        mContext.add.image((width/2), (height/2), 'bg-cj').setScale(1);
        mContext.add.image((width/2), (height/2) + 90, 'cjv1').setScale(1);
        let x = mContext.add.image((width/2) + 240, (height/2) - 450, 'x-cj').setInteractive();
        let continuarBtn = mContext.add.image((width/2), (height) - 85, 'continuar').setInteractive();

        x.on('pointerdown', function (pointer)
        {
            x.setScale(1.2);
            setTimeout(() => {
                mContext.scene.start('Game');
            }, 500);
        });

        x.on('pointerout', () => {
            x.setScale(1);
        });

        continuarBtn.on('pointerdown', function (pointer)
        {
            continuarBtn.setScale(1.2);
            setTimeout(() => {
                mContext.scene.start('Game');
            }, 500);
        });

        continuarBtn.on('pointerout', () => {
            continuarBtn.setScale(1);
        });
    }
}
