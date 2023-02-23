<div class="preloader">
    <div class="left-half start">
        <div class="left-half-text">ПОСЛЕ&nbsp</div>
    </div>
    <div class="right-half start">
        <div class="right-half-text">РЕМОНТА</div>
        <div class="right-half-text small">найдётся всё</div>
    </div>
</div>
<style>
    .preloader {
        position: fixed;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        opacity: 1.0;
        display: flex;
        flex-direction: row;
        z-index: 100000;
        background: none;
    }

    .preloader .left-half {
        position:absolute;
        left: -50vw;
        height: 100vh;
        width:50vw;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        background: #FFF;
        transition-property: left;
        transition-duration: 2.0s;
    }

    .preloader .left-half.start {
        left: 0px;
        transition-property: left;
        transition-duration: 2.0s;
    }

    .preloader .right-half {
        position: absolute;
        padding-top: 5px;
        left: 100vw;
        height: 100vh;
        width: 50vw;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        background: #FFF;
        transition-property: left;
        transition-duration: 2.0s;
        flex-direction: column;
    }

    .preloader .right-half.start{
        left: 50vw;
        transition-property: left;
        transition-duration: 2.0s;
    }    

    .preloader .right-half .right-half-text,
    .preloader .left-half .left-half-text {
        color: #000;
        font-size: 3vw;
        font-weight: 600;
    }

    .preloader .right-half .right-half-text.small {
        color: var(--accent-color);
        font-size: 1vw;
        font-weight: 100;
        margin-top: -15px;
        margin-left: 120px;
    }

</style>