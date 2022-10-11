<?php
if (!defined('ABSPATH')) {
    exit;
}
if (class_exists('ELEMENTOR')){
    return;
}
if (!class_exists('UEI_ICONS')) {

    /**
     * Main BringBack_Elementor_Addons Class
     *
     */
    final class UEI_ICONS
    {
        /** Singleton *************************************************************/
        private static $instance;

        /**
         * Main UEI_ICONS Instance
         *
         * Insures that only one instance of BringBack_Elementor_Addons exists in memory at any one
         * time. Also prevents needing to define globals all over the place.
         */
        public static function instance() {

            if (!isset(self::$instance) && !(self::$instance instanceof UEI_ICONS)) {

                self::$instance = new UEI_ICONS();

                self::$instance->setup_constants();

                self::$instance->includes();

                self::$instance->hooks();

            }
            return self::$instance;
        }

        /**
         * Throw error on object clone
         *
         * The whole idea of the singleton design pattern is that there is a single
         * object therefore, we don't want the object to be cloned.
         */
        public function __clone() {
            // Cloning instances of the class is forbidden
            _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'uei'), UEI_VERSION);
        }

        /**
         * Disable unserializing of the class
         *
         */
        public function __wakeup() {
            // Unserializing instances of the class is forbidden
            _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'uei'), UEI_VERSION);
        }

        /**
         * Setup plugin constants
         *
         */
        private function setup_constants() {

            // Plugin Folder Path
            if (!defined('UEI_PLUGIN_DIR')) {
                define('UEI_PLUGIN_DIR', plugin_dir_path(__FILE__));
            }

            // Plugin Folder URL
            if (!defined('UEI_PLUGIN_URL')) {
                define('UEI_PLUGIN_URL', plugin_dir_url(__FILE__));
            }

        }

        /**
         * Include required files
         *
         */
        private function includes() {
        }

        /**
         * Load Plugin Text Domain
         *
         * Looks for the plugin translation files in certain directories and loads
         * them to allow the plugin to be localised
         */
        public function load_plugin_textdomain() {
        }

        /**
         * Setup the default hooks and actions
         */
        private function hooks() {
            add_action('plugins_loaded', array($this, 'load_plugin_textdomain'));
            add_filter( 'elementor/icons_manager/additional_tabs', array($this, 'add_material_icons_tabs' ) );
            add_action('elementor/frontend/after_enqueue_styles', array($this, 'register_frontend_styles'), 10);
        }

        public function register_frontend_styles() {
            wp_enqueue_style( 'iconoir-icon', 'https://cdn.jsdelivr.net/gh/lucaburgio/iconoir@main/css/iconoir.css');
        }

        public function add_material_icons_tabs( $tabs = array() ) {
            $icons = array("1st-medal", "2x2-cell", "360-view", "3d-add-hole", "3d-arc-center-pt", "3d-arc", "3d-bridge", "3d-center-box", "3d-ellipse-three-pts", "3d-ellipse", "3d-pt-box", "3d-rect-corner-to-corner", "3d-rect-from-center", "3d-rect-three-pts", "3d-select-edge", "3d-select-face", "3d-select-point", "3d-select-solid", "3d-three-pts-box", "4k-display", "Fishing", "accessibility-sign", "accessibility-tech", "accessibility", "activity", "add-circled-outline", "add-database-script", "add-folder", "add-frame", "add-hexagon", "add-keyframe-alt", "add-keyframe", "add-keyframes", "add-lens", "add-media-image", "add-media-video", "add-page", "add-pin-alt", "add-selection", "add-square", "add-to-cart", "add-user", "african-tree", "air-conditioner", "airplane-helix-45deg", "airplane-helix", "airplane-off", "airplane-rotation", "airplane", "airplay", "alarm", "album-carousel", "album-list", "album-open", "album", "align-bottom-box", "align-center", "align-justify", "align-left-box", "align-left", "align-right-box", "align-right", "align-top-box", "antenna-off", "antenna-signal-rounded", "antenna-signal", "antenna", "app-notification", "app-window", "apple-half-alt", "apple-half", "apple-imac-2021-side", "apple-imac-2021", "apple-mac", "apple-swift", "apple-wallet", "apple", "ar-symbol", "arcade", "archery-match", "archery", "archive", "area-search", "arrow-archery", "arrow-down-circled", "arrow-down", "arrow-left-circled", "arrow-left", "arrow-right-circled", "arrow-right", "arrow-separate-vertical", "arrow-separate", "arrow-union-vertical", "arrow-union", "arrow-up-circled", "arrow-up", "asana", "atom", "attachment", "augmented-reality", "auto-flash", "axes", "backward-15-seconds", "bag", "bank", "barcode", "basketball-alt", "basketball-field", "basketball", "battery-25", "battery-50", "battery-75", "battery-charging", "battery-empty", "battery-full", "battery-indicator", "battery-warning", "bbq", "beach-bag-big", "beach-bag", "bed-ready", "bed", "behance-squared", "behance", "bell-notification", "bell-off", "bell", "bicycle", "bin-add", "bin-full", "bin-half", "bin-minus", "bin", "bishop", "bitbucket", "bluetooth-rounded", "bluetooth", "bold-square-outline", "bold", "bonfire", "book-stack", "book", "bookmark-book", "bookmark-circled", "bookmark-empty", "border-bl", "border-bottom", "border-br", "border-inner", "border-left", "border-out", "border-right", "border-tl", "border-top", "border-tr", "bounce-left", "bounce-right", "bowling-ball", "box-iso", "box", "boxing-glove", "brightness-window", "brightness", "bubble-download", "bubble-error", "bubble-income", "bubble-outcome", "bubble-search", "bubble-star", "bubble-upload", "bubble-warning", "building", "bus-outline", "bus-stop", "cable-rounded", "calculator", "calendar", "camera", "cancel", "car-outline", "carbon", "card-wallet", "cart-alt", "cart", "cash", "center-align", "chat-add", "chat-bubble-check", "chat-bubble-check", "chat-bubble-empty", "chat-bubble-error", "chat-bubble-question", "chat-bubble-translate", "chat-bubble-warning", "chat-bubble", "chat-lines", "chat-remove", "check-circled-outline", "check-window", "check", "chocolate", "chromecast-active", "chromecast", "church-alt", "church", "cinema-old", "circle", "city", "clean-water", "clipboard-check", "clock-outline", "closet", "cloud-book-alt", "cloud-check", "cloud-desync", "cloud-download", "cloud-error", "cloud-sunny", "cloud-sync", "cloud-upload", "cloud", "code-brackets-square", "code-brackets", "code", "codepen", "coin", "collage-frame", "collapse", "color-filter", "color-picker-empty", "color-picker", "combine", "compact-disc", "compass", "compress-lines", "compress", "computer", "consumable", "control-slider", "cookie", "copy", "copyright", "corner-bottom-left", "corner-bottom-right", "corner-top-left", "corner-top-right", "cpu-warning", "cpu", "cracked-egg", "creative-commons", "credit-card-2", "credit-card", "crib", "crop-rotate-bl", "crop-rotate-br", "crop-rotate-tl", "crop-rotate-tr", "crop", "css3", "cursor-pointer", "cut-alt", "cut", "cycling", "cylinder", "dash-flag", "dashboard-dots", "dashboard-speed", "dashboard", "data-transfer-both", "data-transfer-check", "data-transfer-down", "data-transfer-up", "data-transfer-warning", "database-backup", "database-export", "database-monitor", "database-restore", "database-rounded", "database-script", "database-settings", "database-star", "database-stats", "db-check", "db-error", "db-search", "db-warning", "db", "de-compress", "delete-circled-outline", "delivery-truck", "delivery", "depth", "design-pencil", "desk", "dialpad", "dice-five", "dice-four", "dice-one", "dice-six", "dice-three", "dice-two", "dimmer-switch", "director-chair", "discord", "dishwasher", "divide-selection-1", "divide-selection-2", "doc-search-alt", "doc-search", "doc-star-alt", "doc-star", "dollar", "domotic-issue", "donate", "double-check", "down-round-arrow", "download-circled-outline", "download-data-window", "download-square-outline", "download", "drag-hand-gesture", "drawer", "dribbble", "drone-charge-full", "drone-charge-half", "drone-charge-low", "drone-check", "drone-error", "drone-landing", "drone-refresh", "drone-take-off", "drone", "droplet-half", "droplet", "ease-curve-control-points", "ease-in-control-point", "ease-in-out", "ease-in", "ease-out-control-point", "ease-out", "ecology-book", "edit-pencil", "edit", "egg", "eject", "electronics-chip", "electronics-transistor", "emoji-ball", "emoji-blink-left", "emoji-blink-right", "emoji-look-bottom", "emoji-look-left", "emoji-look-right", "emoji-look-top", "emoji-puzzled", "emoji-quite", "emoji-really", "emoji-sad", "emoji-satisfied", "emoji-sing-left-note", "emoji-sing-left", "emoji-sing-right-note", "emoji-sing-right", "emoji-surprise-alt", "emoji-surprise", "emoji-talking-angry", "emoji-talking-happy", "emoji-think-left", "emoji-think-right", "emoji", "empty-page", "energy-usage-window", "enlarge-round-arrow", "enlarge", "erase", "error-window", "euro-square", "euro", "ev-charge-alt", "ev-charge", "ev-plug-charging", "ev-plug-error", "ev-plug", "ev-rounded", "ev-station", "exclude", "expand-lines", "expand", "eye-alt", "eye-close", "eye-empty", "eye-off", "face-id", "facebook-squared", "facebook", "facetime", "farm", "fast-arrow-down-box", "fast-arrow-down", "fast-arrow-left-box", "fast-arrow-left", "fast-arrow-right-box", "fast-arrow-right", "fast-arrow-top", "fast-arrow-up-box", "fast-bottom-circle", "fast-left-circle", "fast-right-circle", "fast-top-circle", "favourite-book", "favourite-window", "female", "figma", "file-not-found", "filter-alt", "filter", "finder", "finger-print-window", "fingerprint-circled-error", "fingerprint-circled-lock", "fingerprint-circled-ok", "fingerprint-circled", "fingerprint-phone", "fingerprint-scan", "fingerprint-squared", "fingerprint", "fire-flame", "flare", "flash-off", "flash", "flask", "flip-reverse", "flip", "flower", "fluorine", "fog", "folder-alert", "folder-settings", "folder", "font-size", "football-ball", "football", "forward-15-seconds", "forward-outline", "frame-alt-empty", "frame-alt", "frame-select", "frame-simple", "frame-tool", "frame", "fridge", "fx-rounded", "fx", "gamepad", "garage", "gas-tank-drop", "gas-tank", "gas", "gift", "git-branch", "git-command", "git-commit", "git-compare", "git-fork", "git-merge", "git-pull-request", "github-outline", "github", "gitlab-full", "glass-empty", "glass-half-alt", "glass-half", "glasses", "globe", "golf", "google-circled", "google-docs", "google-drive-check", "google-drive-sync", "google-drive-warning", "google-drive", "google-home", "google-one", "google", "gps", "graph-down", "graph-up", "green-bus", "green-truck", "green-vehicle", "grid-add", "grid-minus", "grid-remove", "group", "gym", "half-cookie", "half-moon", "hand-brake", "handbag", "hard-drive", "hat", "hd-display", "hd", "hdr", "headset-charge", "headset-help", "headset-issue", "headset", "health-shield", "healthcare", "heart", "heavy-rain", "heptagon", "her-slips", "hesa-warning-outline", "hexagon-alt", "hexagon-dice", "hexagon", "high-priority", "historic-shield-alt", "historic-shield", "home-alt-slim-horiz", "home-alt-slim", "home-alt", "home-hospital", "home-sale", "home-secure", "home-shield", "home-simple-door", "home-simple", "home-table", "home-user", "home", "horiz-distribution-left", "horiz-distribution-right", "hospital-sign", "hospital", "hot-air-balloon", "hourglass", "html5", "hydrogen", "iconoir", "import", "industry", "infinite", "info-empty", "input-field", "input-output", "input-search", "instagram", "internet", "intersect-alt", "intersect", "ios-settings", "ip-address", "iris-scan", "italic-square-outline", "italic", "journal-page", "journal", "kanban-board", "key-alt-back", "key-alt-minus", "key-alt-plus", "key-alt-remove", "key-alt", "keyframe-align-center", "keyframe-align-horizontal", "keyframe-align-vertical", "keyframe-position", "keyframe", "keyframes-couple", "keyframes", "label-outline", "lamp", "language", "laptop-charging", "laptop-fix", "laptop-issue", "laptop", "large-suitcase", "layout-left", "layout-right", "leaderboard-star", "leaderboard", "leaf", "left-round-arrow", "lens", "lifebelt", "light-bulb-off", "light-bulb-on", "light-bulb", "line-space", "linear", "link", "linkedin", "linux", "list", "load-action-floppy", "lock-key", "lock", "locked-book", "locked-window", "log-denied", "log-in", "log-out", "long-arrow-down-left", "long-arrow-down-right", "long-arrow-left-down", "long-arrow-left-up", "long-arrow-right-down", "long-arrow-right-up", "long-arrow-up-left", "long-arrow-up-right", "lot-of-cash", "mac-control-key", "mac-dock", "mac-option-key", "mac-os-window", "magnet-energy", "magnet", "mail-opened", "mail", "male", "map-issue", "map", "maps-arrow-diagonal", "maps-arrow-issue", "maps-arrow", "maps-go-straight", "maps-turn-back", "maps-turn-left", "maps-turn-right", "mask-square", "math-book", "maximize", "medal", "media-image-folder", "media-image-list", "media-image", "media-video-folder", "media-video-list", "media-video", "medium", "megaphone", "menu-scale", "menu", "message-alert", "message-text", "message", "metro", "mic-add", "mic-check", "mic-mute", "mic-remove", "mic-speaking", "mic-warning", "mic", "minus-hexagon", "minus-pin-alt", "minus-square", "minus", "mirror", "missing-font", "modern-tv-4k", "modern-tv", "money-square", "moon-sat", "more-horiz-circled-outline", "more-horiz", "more-vert-circled-outline", "more-vert", "motorcycle", "mouse-button-left", "mouse-button-right", "mouse-scroll-wheel", "move-down", "move-left", "move-right", "move-ruler", "move-up", "movie", "multi-bubble", "multi-mac-os-window", "multi-window", "multiple-pages-add", "multiple-pages-delete", "multiple-pages-empty", "multiple-pages-remove", "multiple-pages", "music-1-add", "music-1", "music-2-add", "music-2", "nav-arrow-down", "nav-arrow-left", "nav-arrow-right", "nav-arrow-up", "navigator-alt", "navigator", "network-alt", "network-left", "network-right", "network", "new-tab", "nintendo-switch", "nitrogen", "no-access-window", "no-battery", "no-coin", "no-credit-card", "no-link", "no-lock", "no-smoking-circled", "no-smoking", "notes", "numbered-list-left", "numbered-list-right", "octagon", "off-rounded", "oil-industry", "on-rounded", "one-finger-select-hand-gesture", "one-point-circle", "open-book", "open-in-browser", "open-in-window", "open-new-window", "open-select-hand-gesture", "open-vpn", "orange-half", "orange-slice-alt", "orange-slice", "organic-food-squared", "organic-food", "orthogonal-view", "oxygen", "package-lock", "package", "packages", "pacman", "page-edit", "page-flip", "page-search", "page-star", "page", "palette", "panorama-enlarge", "panorama-reduce", "pants-alt", "pants", "parking", "password-cursor", "password-error", "password-pass", "paste-clipboard", "pause-outline", "pause-window", "pc-check", "pc-firewall", "pc-mouse", "pc-no-entry", "pc-warning", "peace-hand", "pen-connect-bluetooth", "pen-connect-wifi", "pen-tablet-connect-usb", "pen-tablet-connect-wifi", "pen-tablet", "pentagon", "people-rounded", "percentage-round", "percentage-square", "percentage", "perspective-view", "pharmacy-circled-cross", "pharmacy-squared-cross", "phone-add", "phone-delete", "phone-disabled", "phone-income", "phone-outcome", "phone-paused", "phone-remove", "phone", "piggy-bank", "pillow", "pin-alt", "pin", "pine-tree", "pinterest", "pizza-slice", "planet-alt", "planet-sat", "planet", "play-outline", "playlist-add", "playlist-play", "playlist", "playstation-gamepad", "plug-type-a", "plug-type-c", "plug-type-g", "plug-type-l", "plus", "pocket", "podcast", "pokeball", "position-align", "position", "potion", "pound", "precision-tool", "printer-alt", "printer", "printing-page", "priority-down", "priority-up", "private-wifi", "profile-circled", "prohibition", "puzzle", "qr-code", "question-mark-circle", "question-mark", "question-square-outline", "quote-message", "quote", "rain", "receive-dollars", "receive-euros", "receive-pounds", "receive-yens", "redo-action", "redo-circle", "redo", "reduce-round-arrow", "reduce", "refresh-circular", "refresh-double", "refresh", "reload-window", "reminder-hand-gesture", "remove-database-script", "remove-empty", "remove-folder", "remove-frame", "remove-from-cart", "remove-keyframe-alt", "remove-keyframe", "remove-keyframes", "remove-link", "remove-media-image", "remove-media-video", "remove-page", "remove-pin-alt", "remove-pin", "remove-selection", "remove-square", "remove-user", "repeat-once", "repeat", "report-columns", "reports", "repository", "restart", "rewind-outline", "rhombus", "right-round-arrow", "rings", "rocket", "rook", "rotate-camera-left", "rotate-camera-right", "round-flask", "rounded-mirror", "rss-feed-squared", "rss-feed", "ruler-add", "ruler-combine", "ruler-remove", "ruler", "running", "safari", "sandals", "save-action-floppy", "save-floppy-disk", "scale-frame-enlarge", "scale-frame-reduce", "scan-barcode", "scan-qr-code", "scanning", "scarf", "scissor-alt", "scissor", "sea-and-sun", "sea-waves", "search-engine", "search-font", "search-window", "search", "secure-window", "security-pass", "select-window", "selection", "selective-tool", "send-dollars", "send-euros", "send-pounds", "send-yens", "server-connection", "server", "settings-cloud", "settings-profiles", "settings", "share-android", "share-ios", "shield-add", "shield-alert", "shield-alt", "shield-broken", "shield-check", "shield-cross", "shield-download", "shield-eye", "shield-loading", "shield-minus", "shield-question", "shield-search", "shield-upload", "shield", "shop-alt", "shop", "shopping-bag-add", "shopping-bag-alt", "shopping-bag-arrow-down", "shopping-bag-arrow-up", "shopping-bag-check", "shopping-bag-issue", "shopping-bag-remove", "shopping-bag", "shopping-code-check", "shopping-code-error", "shopping-code", "short-pants-alt", "short-pants", "shuffle", "sidebar-collapse", "sidebar-expand", "sigma-function", "simple-cart", "single-tap-gesture", "skateboard", "skateboarding", "skip-next-outline", "skip-prev-outline", "sleeper-chair", "small-lamp-alt", "small-lamp", "small-shop-alt", "small-shop", "smartphone-device", "smoking", "snapchat", "snow-flake", "snow", "soap", "soccer-ball", "sofa", "soil-alt", "soil", "sort-down", "sort-up", "sort", "sound-high", "sound-low", "sound-min", "sound-off", "spades", "sphere", "spiral", "spock-hand-gesture", "square", "stackoverflow", "star-dashed", "star-half-dashed", "star-outline", "stat-down", "stat-up", "stats-report", "stats-square-down", "stats-square-up", "stretching", "stroller", "style-border", "substract", "suggestion", "sun-light", "swimming", "swipe-down-gesture", "swipe-left-gesture", "swipe-right-gesture", "swipe-two-fingers-down-gesture", "swipe-two-fingers-left-gesture", "swipe-two-fingers-right-gesture", "swipe-two-fingers-up-gesture", "swipe-up-gesture", "switch-off-outline", "switch-on-outline", "system-restart", "system-shut", "table-2-columns", "table-rows", "table", "task-list", "telegram-circled", "telegram", "tennis-ball-alt", "tennis-ball", "terminal-outline", "terminal-simple", "test-tube", "text-alt", "text-size", "text", "three-points-circle", "three-stars", "thumbs-down", "thumbs-up", "thunderstorm", "tiktok", "timer-off", "timer", "tournament", "tower-check", "tower-no-access", "tower-warning", "tower", "trademark", "train-outline", "tram", "transition-bottom", "transition-left", "transition-right", "transition-top", "translate", "trash", "treadmill", "tree", "trekking", "trello", "triangle-flag-circle", "triangle-flag-full", "triangle-flag", "triangle", "trophy", "truck-length", "truck", "tunnel", "tv-fix", "tv-issue", "tv", "twitter-verified-badge", "twitter", "two-points-circle", "two-seater-sofa", "type", "umbrella-full", "underline-square-outline", "underline", "undo-action", "undo-circle", "undo", "union-alt", "union-horiz-alt", "union", "unity-5", "unity", "up-round-arrow", "upload-data-window", "upload-square-outline", "upload", "usb", "user-bag", "user-cart", "user-circle-alt", "user-scan", "user-square-alt", "user", "vegan-rounded", "vegan-squared", "vegan", "verified-badge", "verified-user", "video-camera-off", "video-camera", "view-columns-2", "view-columns-3", "view-grid", "view-structure-down", "view-structure-up", "voice-circled-lock", "voice-circled", "voice-error", "voice-ok", "voice-phone", "voice-scan", "voice-squared", "voice", "vr-symbol", "waist", "walking", "wallet", "warning-circled-outline", "warning-square-outline", "warning-triangle-outline", "warning-window", "wash", "washing-machine", "watering-soil", "web-window-close", "web-window-energy-consumption", "web-window", "weight-alt", "weight", "white-flag", "wifi-error", "wifi-issue", "wifi-off", "wifi-rounded", "wifi-signal-none", "wifi", "wind", "windows", "wrap-text", "wristwatch", "www", "xbox-a", "xbox-b", "xbox-x", "xbox-y", "xray-view", "yen-square", "yen", "yoga", "youtube", "zoom-in", "zoom-out", "add-page-alt", "angle-tool", "avi-format", "bread-slice", "closed-captions", "clutery", "coffee-cup", "design-nib", "forward-message", "forward", "gif-format", "hammer", "jpeg-format", "jpg-format", "list-select", "mail-in", "mail-out", "mpeg-format", "npm-square", "npm", "png-format", "raw-format", "remove-page-alt", "reply-to-message", "reply", "screenshot", "send-diagonal", "send-mail", "send", "submit-document", "svg-format", "text-box", "tif-format", "tiff-format", "tools", "webp-format", "wrench", );

            $tabs['iconoir'] = array(
                'name'          => 'ueiiconoir',
                'label'         => esc_html__( 'Iconoir', 'uei' ),
                'labelIcon'     => 'iconoir-2x2-cell',
                'prefix'        => 'iconoir-',
                'displayPrefix' => 'ueiiconoir',
                'url'           => 'https://cdn.jsdelivr.net/gh/lucaburgio/iconoir@main/css/iconoir.css',
                'icons'         => $icons,
                'ver'           => '3.0.1',
            );
            return $tabs;
        }
    }
}

function UEI_ICONS() {
    return UEI_ICONS::instance();
}

// Get Bringback Running
UEI_ICONS();