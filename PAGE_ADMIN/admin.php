<?php
require
class Event {
  private $pdo;

  public function __construct($host, $dbname, $user, $password) {
    $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  // Ajouter un événement
  public function addEvent($nom, $date, $lieu, $description) {
    $stmt = $this->pdo->prepare("INSERT INTO evenements (nom, date, lieu, description) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nom, $date, $lieu, $description]);
  }

  // Récupérer tous les événements
  public function getEvents() {
    $stmt = $this->pdo->query("SELECT * FROM evenements");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Supprimer un événement
  public function deleteEvent($id) {
    $stmt = $this->pdo->prepare("DELETE FROM evenements WHERE id = ?");
    $stmt->execute([$id]);
  }

  // Modifier un événement
  public function updateEvent($id, $nom, $date, $lieu, $description) {
    $stmt = $this->pdo->prepare("UPDATE evenements SET nom = ?, date = ?, lieu = ?, description = ? WHERE id = ?");
    $stmt->execute([$nom, $date, $lieu, $description, $id]);
  }
}
?>
