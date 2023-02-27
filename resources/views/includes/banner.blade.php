<div class="banner{{--start--}}">
    <div class="banner__image"><img src="/public/images/original.webp"></div>
    {{-- <div class="banner__text">Купить или продать вещи после ремонта</div> --}}
    <div class="banner__text">Платформа покупки/продажи вещей после ремонта</div>
</div>
<style>
    .banner {
        width: 100%;
        width: var(--max-width-container);
        margin: 0px 0px 0px 0px;
        padding: 0px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        transition: 1.0s;
        transform: scale(1.0);
        z-index: 0;
    }

    .banner__text {
        position: absolute;
        padding-top: 30px;
        padding-left: 300px;
        padding-right: 300px;
        /*color: var(--accent-color);*/
        color: var(--accent-add-color);
        font-weight: 600;
        text-shadow: 0px 0px 8px #777;
        user-select: none;
    }

    @media (min-width: 0px) and (max-width: 1199px) {
        .banner__text {
            font-size: calc( (100vw - 320px)/(1200 - 320) * (65 - 16) + 16px);
        }

    }

    @media (min-width: 1200px) {
        .banner__text {
            font-size: 65px;
        }

    }

    .banner__image {
        display: flex;
        width: 100%;
        height: calc(100vh - 397px);
    }

    .banner__image img {
        width: 100%;
        object-fit: cover;
    }

</style>