<form method="get" class="search-form" action="<?php echo esc_url( home_url('/') ); ?>">
    <div class="search-form-container">
        <input type="text" placeholder="サイト内を検索" name="s" class="search-field" value="" />
        <button type="submit" class="search-submit">
            <i class="fas fa-search"></i>
            <span class="search-text">検索</span>
        </button>
    </div>
</form>
