<div class="mobile-dropdown">
    <div class="m-util">
    <div class="m-language-switch">
        <select name="lang" class="secondarybtn lang">
            <option value="ca" <?php if($lang == 'ca') echo "selected" ?>>Català</option>
            <option value="es" <?php if($lang == 'es') echo "selected" ?>>Español</option>
            <option value="en" <?php if($lang == 'en') echo "selected" ?>>English</option>
            <option value="de" <?php if($lang == 'de') echo "selected" ?>>Deutsch</option>
            <option value="gl" <?php if($lang == 'gl') echo "selected" ?>>Galego</option>
            <option value="ko" <?php if($lang == 'ko') echo "selected" ?>>한국어</option>
            <option value="ro" <?php if($lang == 'ro') echo "selected" ?>>Româna</option>
            <option value="lt" <?php if($lang == 'lt') echo "selected" ?>>Lietuvių</option>
            <option value="eu" <?php if($lang == 'eu') echo "selected" ?>>Euskera</option>
        </select>
    </div>
    <hr>
    <div class="m-login">
        <a href="/login.php" class="secondarybtn"><?php echo $locals->header->login ?></a>
        <a href="/register.php" class="primarybtn"><?php echo $locals->header->register ?></a>
    </div>
    <div class="m-account"></div>

    </div>
    
    <div class="m-close-btn"><img src="/assets/img/closeicon.svg" alt="X"></div>
</div>
<header>
    <div class="lang-wrapper">
        <select name="lang" class="lang secondarybtn">
            <option value="ca" <?php if($lang == 'ca') echo "selected" ?>>Català</option>
            <option value="es" <?php if($lang == 'es') echo "selected" ?>>Español</option>
            <option value="en" <?php if($lang == 'en') echo "selected" ?>>English</option>
            <option value="de" <?php if($lang == 'de') echo "selected" ?>>Deutsch</option>
            <option value="gl" <?php if($lang == 'gl') echo "selected" ?>>Galego</option>
            <option value="ko" <?php if($lang == 'ko') echo "selected" ?>>한국어</option>
            <option value="ro" <?php if($lang == 'ro') echo "selected" ?>>Româna</option>
            <option value="lt" <?php if($lang == 'lt') echo "selected" ?>>Lietuvių</option>
            <option value="eu" <?php if($lang == 'eu') echo "selected" ?>>Euskera</option>
        </select>
        <script src="/assets/js/swaplang.js"></script>
        <script src="/assets/js/title.js"></script>
    </div>
    <div class="title">
        <span id="title" class="forum-title">
            Bamboo Forum
        </span>
    </div>
    <div class="account">

        <div class="nologin <?php echo $session == '1' ? ' ehidden' : '' ?>" <?php 
            if($session == '1') {
                echo 'hidden';
            }
        ?>>
            <div>
            <a href="/login.php" class="secondarybtn"><?php echo $locals->header->login ?></a>
            <a href="/register.php" class="primarybtn"><?php echo $locals->header->register ?></a>
            </div>
            
        </div>
        <div class="yeslogin" <?php 
            if($session == '0') {
                echo 'hidden';
            }
        ?>>
            <a href="/user.php?username=<?php echo isset($sessiondata['name']) ? $sessiondata['name'] : '' ?>">
                    <img src="<?php echo isset($sessiondata['id']) ? '/assets/img/users/'.$sessiondata['id'].'.png' : '#'; ?>" alt="pfp">
                    <span class="username"><?php echo isset($sessiondata['name']) ? $sessiondata['name'] : ''; ?></span>
            </a>
            <a href="/edituser.php?username=<?php echo isset($sessiondata['name']) ? $sessiondata['name'] : ''; ?>"><?php echo $locals->header->edit ?></a>
            <a href="/api/auth/logoff.php"><?php echo $locals->header->logout ?></a>
        </div>
    </div>
    <div class="mobile-dropdown-button-wrapper">
        <button class="mobile-dropdown-button primarybtn">🍔</button>
    </div>
</header>
