<?php

class quoideneuf
{
	private $_bdd; //Instance de PDO
	
	public function __construct($db)
	{
		// Récupération de l'instance PDO
		$this->_bdd = $db;
	}		
	
	public function getListNews()
	{
		$liste = array();
		
		$SQL = $this->_bdd->query('SELECT ID, date_news, news FROM news ORDER BY date_news DESC LIMIT 0,9');
		while ($data = $SQL->fetch(PDO::FETCH_ASSOC))
		{
			$liste[] = $data;
		}
		$SQL->closeCursor();
		return $liste;
 	}
	
	public function ajoutNews($dnews, $message)
	{
		// Insertion de news
		$SQL = $this->_bdd->prepare('INSERT INTO news(date_news,news) VALUE (?, ?)');
		$SQL->execute(array($dnews,$message));
		if($SQL)
		{
			return True;
		}
		else
		{
			return False;
		}
		$SQL->closeCursor();		
	}
	
	public function delNews($id)
	{
		//Suppression de news
		$SQL = $this->_bdd->query('DELETE FROM news WHERE ID=' . $id);
		if($SQL)
		{
			return True;
		}
		else
		{
			return False;
		}
		$SQL->closeCursor();	
	}
}