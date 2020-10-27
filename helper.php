<?php
/**
 * Helper class for Hello World! module
 *
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @link http://docs.joomla.org/J3.x:Creating_a_simple_module/Developing_a_Basic_Module
 * @license        GNU/GPL, see LICENSE.php
 * mod_contentcarousel is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
class modContentCarouselHelper
{
    /**
     * Retrieves the hello message
     *
     * @param   array  $params An object containing the module parameters
     *
     * @access public
     */
    public static function getCategoryArticles($params)
    {
        // Obtain a database connection
        $db = JFactory::getDbo();
        $catid = $params->get('catid', null);
        $limit = $params->get('limit', null);
        // Retrieve the shout
        $query = $db->getQuery(true)
                    ->select($db->quoteName('id'))
                    ->select($db->quoteName('catid'))
                    ->select($db->quoteName('title'))
                    ->select($db->quoteName('introtext'))
                    ->select($db->quoteName('fulltext'))
                    ->from($db->quoteName('#__content'))
                    ->where('catid = ' . $db->Quote($catid))
                    ->where('state = 1')
                    ->setLimit($db->Quote($limit));
        // Prepare the query
        $db->setQuery($query);
        // Load the row.
        $results = $db->loadObjectList();
        foreach($results as $result){
          // set link
          $result->url = self::getArticleUrl($result);
          // set short text
          $result->short = self::getShortText($result->introtext);
          // set image
          $result->image = "";
          $img = self::getArticleImage($result->introtext);
          if ( $img != "" ){
            $result->image = $img;
          }
        }
        // Return the Hello
        return $results;
    }



    public static function getArticleUrl($article)
    {
      $url = "#";
      if( !is_null($article->id) ){
        $url = JURI::root()."index.php?option=com_content&view=article&id=".$article->id;
      }
      return $url;
    }


    public static function getShortText($string)
    {
      $string = strip_tags($string);
      if( strlen($string)>100 ){
        $string = mb_substr($string,0,100)."...";
      }
      return $string;
    }



    public static function getArticleImage($string)
    {
      $pattern = '/<img(.*?)src=("|\'|)(.*?)("|\'| )(.*?)>/i';
      // $m = preg_match_all($pattern,$string,$matches);
      $m = preg_match($pattern, $string, $matches, PREG_OFFSET_CAPTURE, 0);
      return $matches[3][0];
    }

}
