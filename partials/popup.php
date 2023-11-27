<style>
    #pagination-page-control-button {
        cursor: pointer;
    }
    .popup-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0,0,0,.5);
        z-index: 90;
        display: none;
    }
    .popup-wrapper.active {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .popup {
        padding: 20px;
        z-index: 1000;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        background-color: var(--primary-color);
        border-radius: 5px;
    }

    #replyTextarea {
        width: 400px;
        height: 200px;
        box-sizing: border-box;
        resize: vertical;
    }

    #popup-button-send {
        margin-top: 10px;
        margin-left: 0;
    }
    #popup .popup-buttons {
        width: 100%;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    #popup-button-cancel {
        margin-top: 10px;
        margin-right: 0;
    }
    #popup button {
        width: 100%;
    }
</style>
<div id="popup" class="popup-wrapper">
    <form class="popup" method="POST" action="/api/posts/new.php">
        <input type="hidden" name="post_thread_id" value="<?php echo $_GET['thread_id'] ?>">
        <textarea name="post_text" id="replyTextarea" placeholder="<?php echo $locals->popup->textarea ?>"></textarea>
        <div class="popup-buttons">
            <button id="popup-button-cancel" class="secondarybtn"><?php echo $locals->popup->btn_cancel ?></button>
            <button type="submit" id="popup-button-send" class="primarybtn"><?php echo $locals->popup->btn ?></button>
        </div>
    </form>
</div>
