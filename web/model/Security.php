<?php
class Security {
    public static $seed = '3119985666';
    public static function hacher($texte_en_clair) {
        $texte_hache = hash('sha256', Security::$seed . $texte_en_clair);
        return $texte_hache;
    }
}
?>