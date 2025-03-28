<style>
    .paper {
        position: relative;
        width: 100%;
        /* max-width: 1000px; */
        min-width: 400px;
        height: 450px;
        margin: 0 auto;
        background: #F1F2B5;
        border-radius: 5px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .3);
        overflow: hidden;
    }

    .paper:before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        width: 60px;
        background: radial-gradient(#575450 6px, transparent 7px) repeat-y;
        background-size: 30px 30px;
        border-right: 3px solid #A8CABA;
        box-sizing: border-box;
    }

    .paper-content {
        position: absolute;
        top: 20px;
        right: 10px;
        bottom: 20px;
        left: 60px;
        background: linear-gradient(transparent, transparent 28px, #A8CABA 28px);
        background-size: 30px 30px;
    }

    .paper-content textarea {
        width: 100%;
        max-width: 100%;
        height: 100%;
        max-height: 100%;
        line-height: 30px;
        padding: 0 10px;
        border: 0;
        outline: 0;
        background: transparent;
        color: black;
        /* font-family: 'Handlee', cursive; */
        font-weight: 500;
        font-size: 16px;
        box-sizing: border-box;
        z-index: 1;
    }
</style>

<!-- Paper Remark -->
<div class="paper mt-3 mb-3">
    <div class="paper-content">
        <textarea autofocus disabled><?= $lmnote->lm_remark_text ?></textarea>
    </div>
</div>
<!-- Paper Remark end-->