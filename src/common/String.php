<?php
namespace Phpingguo\ApricotLib\Common;

/**
 * 文字列操作を拡張するためのクラスです。
 * 
 * @final [継承禁止クラス]
 * @author hiroki sugawara
 */
final class String
{
    /**
     * 入力文字列が有効な文字列であるかどうかを調べます。
     * 
     * @param mixed $value 有効であるかどうかを調べる文字列
     * 
     * @return Boolean 有効な文字列の場合は true。それ以外の場合は false。
     */
    public static function isValid($value)
    {
        return (is_string($value) && $value !== '');
    }
    
    /**
     * キーワードリストのうち一つが指定した文字列に含まれるかどうかを検出します。
     * 
     * @param String $string                    検索対象の文字列
     * @param Array $needle_list                検索するキーワードのリスト
     * @param String $ignore_case [初期値=true] 大文字小文字を区別しないかどうか
     * 
     * @return Boolean キーワードリストのうち一つが検索対象の文字列に含まれる場合は true。
     * それ以外の場合は false。
     */
    public static function isContains($haystack, array $needle_list, $ignore_case = true)
    {
        if (static::isValid($haystack)) {
            $exec_method = ($ignore_case === true) ? 'stripos' : 'strpos';
            
            foreach ($needle_list as $needle) {
                if ($exec_method($haystack, $needle) !== false) {
                    return true;
                }
            }
        }
        
        return false;
    }
    
    /**
     * 名前空間を伴うクラス名から名前空間を削除したものを取得します。
     * 
     * @param String $class_name 名前空間を削除したいクラス名
     * 
     * @return String 指定したクラスが存在する場合は名前空間を削除した名前。
     * それ以外の場合は空白文字列。
     */
    public static function removeNamespace($class_name)
    {
        if (static::isValid($class_name) && class_exists($class_name, false)) {
            return trim(strrchr($class_name, '\\'), '\\');
        }
        
        return '';
    }
    
    /**
     * 正規表現検索を行い、期待しない値以外の値と一致するかどうかを判別します。
     * 
     * @param String $search      検索対象の文字列
     * @param String $regex_value 正規表現文字列
     * @param mixed $not_expected 正規表現検索の実行結果の期待しない値
     * (0=マッチする又は失敗, 1=マッチしない又は失敗, false=マッチする又はマッチしない)
     * 
     * @return Boolean 期待しない値以外の値と一致する場合は true。それ以外の場合は false。
     */
    public static function isNotRegexMatched($search, $regex, $not_expected)
    {
        return (isset($regex) && $not_expected !== preg_match($regex, $search));
    }
}
