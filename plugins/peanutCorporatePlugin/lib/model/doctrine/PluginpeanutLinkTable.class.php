<?php

/**
 * peanutLinkTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class PluginpeanutLinkTable extends Doctrine_Table
{
  /**
   * Returns an instance of this class.
   *
   * @return object peanutLinkTable
   */
  public static function getInstance()
  {
    return Doctrine_Core::getTable('peanutLink');
  }

  /**
   * Retrieves link object.
   *
   * @return peanutLink
   */
  public function getItem()
  {
    $p = $this->createQuery('p')
            ->leftJoin('p.sfGuardUser s')
            ->leftJoin('p.peanutMenu m')
            ->leftJoin('p.peanutXfn x')
            ->leftJoin('p.peanutSeo o')
            ->orderBy('p.position ASC');

    return $p;
  }

  /**
   * Retrieves link object.
   *
   * @param  string|int $item     The id or slug of item
   *
   * @return peanutLink
   */
  public function showItem($item)
  {
    $p = $this->getItem()
            ->where('p.id = ?', $item)
            ->orWhere('p.slug = ?', $item);

    return $p;
  }

  /**
   * Retrieves link object.
   *
   * @param  string     $status   The status of items
   *
   * @return peanutLink
   */
  public function getItems($status = 'publish')
  {
    $p = $this->getItem()
            ->where('p.status = ?', $status);

    return $p;
  }

  /**
   * Retrieves links object by menu.
   *
   * @param  string|int $menu     The id or slug of menu
   * @param  string     $status   The status of items
   *
   * @return peanutLink
   */
  public function getItemsByMenu($menu, $status = 'publish')
  {
    $p = $this->getItem()
            ->where('m.id = ? OR m.slug = ?', array($menu, $menu))
            ->andWhere('p.status = ?', $status);

    return $p;
  }

  /**
   * Retrieves links object by author.
   *
   * @param  string|int $author     The id or username of user
   * @param  string     $status   The status of items
   *
   * @return peanutLink
   */
  public function getItemsByAuthor($author, $status = 'publish')
  {
    $p = $this->getItem()
            ->where('s.id = ? OR s.username = ?', array($author, $author))
            ->andWhere('p.status = ?', $status);

    return $p;
  }

  /**
   * Retrieves links object by relation.
   *
   * @param  string     $rel      The relation of item
   * @param  string     $status   The status of items
   *
   * @return peanutLink
   */
   public function getItemsByRelation($rel, $status = 'publish')
   {
     $p = $this->getItem()
             ->leftJoin('p.peanutXfn x')
             ->where('x.me LIKE ?', '%' . $rel . '%')
             ->orWhere('x.friendship LIKE ?', '%' . $rel . '%')
             ->orWhere('x.physical LIKE ?', '%' . $rel . '%')
             ->orWhere('x.professional LIKE ?', '%' . $rel . '%')
             ->orWhere('x.geographical LIKE ?', '%' . $rel . '%')
             ->orWhere('x.family LIKE ?', '%' . $rel . '%')
             ->orWhere('x.romantic LIKE ?', '%' . $rel . '%')
             ->orderBy('p.position ASC');

     return $p;
   }
}