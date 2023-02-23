class Offer {

    constructor() {
        console.log(this.constructor.name);
        // this.MakeSlider();
        this.MakeKeys();
    }

    MakeSlider() {
        this.slider = $('#offer-images');
        this.isDown = false;
        this.startX;
        this.scrollLeft;
        this.scrollTo;
    
        console.debug('MakeSlider', this.slider);
        
        this.slider.on('mousedown', (e) => {
          this.isDown = true;
          this.slider.addClass('active');
          this.startX = e.pageX - this.slider.offset().left;
          this.scrollLeft = this.slider.scrollLeft();
          console.debug('Slider mouse down');
        });

        this.slider.on('mouseleave', () => {
            this.isDown = false;
            this.slider.removeClass('active');
        });

        this.slider.on('mouseup', () => {
            this.isDown = false;
            this.slider.removeClass('active');
        });

        this.slider.on('mousemove', (e) => {
            if(!this.isDown) return;
            e.preventDefault();
            const x = e.pageX - this.slider.offset().left;
            const walk = (x - this.startX) * 3; //scroll-fast
            this.slider.scrollLeft(this.scrollLeft - walk);
        });
    }


    MakeKeys() {
    }

}

new Offer();