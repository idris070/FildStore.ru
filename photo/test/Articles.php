<?php defined('SYSPATH') or die('No direct script access.');

class Model_Articles
{
	public function getArticles() // функция получения всех статей из БД как массива
    {
		return DB::select('name', 'text')
                ->from('articles')
                ->execute()
                ->as_array(); 
    }

	public function addArticle($name,$text) // функция добавления новой статьи в БД
    {
		return DB::insert('articles', array('name', 'text'))
            	->values(array($name, $text))
                ->execute();
    }

}