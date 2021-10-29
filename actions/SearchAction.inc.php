<?php 

require_once("models/SurveysModel.inc.php");
require_once("actions/Action.inc.php");

class SearchAction extends Action {

	/**
	 * Construit la liste des sondages dont la question contient le mot clé
	 * contenu dans la variable $_POST["keyword"]. Cette liste est stockée dans un modèle
	 * de type "SurveysModel". L'utilisateur est ensuite dirigé vers la vue "ServeysView"
	 * permettant d'afficher les sondages.
	 *
	 * Si la variable $_POST["keyword"] est "vide", le message "Vous devez entrer un mot clé
	 * avant de lancer la recherche." est affiché à l'utilisateur.
	 *
	 * @see Action::run()
	 */
	public function run() {
		/* TODO  */
		if(!empty($_POST['keyword'])){
			$keyword = htmlentities($_POST['keyword']);
			$this->database->loadSurveysByKeyword($keyword);
			if($this->database){
				$this->setModel(new SurveysModel());
				$this->setView(getViewByName('SurveysView'));
			}
			else{
				$this->setView(getViewByName('Default'));
			}

		}

		else{
			$this->setModel(new MessageModel());
			$this->getModel()->setMessage("Vous devez entrer un mot clé avant de lancer la recherche");
			$this->setView(getViewByName("Message"));
		}
	}

}

?>
