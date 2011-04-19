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
   * @param  string|int $item     The id or slug of item
   *
   * @return peanutLink
   */
  public function getItem($item)
  {
    $p = $this->createQuery('p')
            ->leftJoin('p.sfGuardUser s')
            ->leftJoin('p.peanutMenu m')
            ->leftJoin('p.peanutXfn x')
            ->where('p.id = ?', $item)
            ->orWhere('p.slug = ?', $item)
            ->orderBy('p.position ASC');

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
    $p = $this->createQuery('p')
            ->leftJoin('p.sfGuardUser s')
            ->leftJoin('p.peanutMenu m')
            ->leftJoin('p.peanutXfn x')
            ->where('p.status = ?', $status)
            ->orderBy('p.created_at DESC');

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
    $p = $this->createQuery('p')
            ->leftJoin('p.sfGuardUser s')
            ->leftJoin('p.peanutMenu m')
            ->leftJoin('p.peanutXfn x')
            ->where('m.id = ? OR m.slug = ?', array($menu, $menu))
            ->andWhere('p.status = ?', $status)
            ->orderBy('p.position ASC');

    return $p;
  }

  /**
   * Retrieves links object by user.
   *
   * @param  string|int $user     The id or username of user
   * @param  string     $status   The status of items
   *
   * @return peanutLink
   */
  public function getItemsByUser($user, $status = 'publish')
  {
    $p = $this->createQuery('p')
            ->leftJoin('p.sfGuardUser s')
            ->leftJoin('p.peanutMenu m')
            ->leftJoin('p.peanutXfn x')
            ->where('s.id = ? OR s.username = ?', array($user, $user))
            ->andWhere('p.status = ?', $status)
            ->orderBy('p.position ASC');

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
     $p = $this->createQuery('p')
             ->leftJoin('p.sfGuardUser s')
             ->leftJoin('p.peanutMenu m')
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