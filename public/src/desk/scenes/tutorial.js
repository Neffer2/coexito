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
        mContext.add.image((width/2) + 200, (height/2) - 30, 'cjv1').setScale(1);
        mContext.add.image((width/4) + 30, (height/2), 'cj_logo').setScale(1);
        let x = mContext.add.image((width/2) + 650, (height/2) - 380, 'x-cj').setInteractive();
        let continuarBtn = mContext.add.image((width/2) + 210, (height) - 160, 'continuar').setInteractive();

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
