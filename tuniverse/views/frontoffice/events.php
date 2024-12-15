<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/kaiadmin-lite-1.2.0/view/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/kaiadmin-lite-1.2.0/view/assets/css/plugins.min.css" />
    <link rel="stylesheet" href="/kaiadmin-lite-1.2.0/view/assets/css/kaiadmin.min.css" />
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <title>Events</title>
</head>
<body>
    <header>
        <h1>Discover Tunisia - Events</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="contact.php">Contact</a>
        </nav>
    </header>
    <main>
        <section>
            <h2>Upcoming Events</h2>
            <div class="places-container">
                <?php
                require_once '../../config/config.php'; 

                try {
                    $pdo = config::getConnexion();
                    
                    $sql = "SELECT * FROM events";
                    $stmt = $pdo->query($sql);
                
                    if ($stmt->rowCount() > 0) {
                        echo '<div class="container">';
                        echo '<div class="row">';
                
                        foreach ($stmt as $row) {
                            echo '
                            <div class="col-md-20 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                    <img src='.htmlspecialchars($row['images']).' width="120px" height="70px">
                                    <h2>' . htmlspecialchars($row['Nom']) . '</h2>
                                    </div>
                                    <div class="card-body">
                                        
                                        <p><strong>Description:</strong> ' . htmlspecialchars($row['description']) . '</p>
                                        <p><strong>Location:</strong> ' . htmlspecialchars($row['localisation']) . '</p>
                                        <p><strong>Category:</strong> ' . htmlspecialchars($row['category']) . '</p>
                                        <p><strong>Price:</strong> ' . htmlspecialchars($row['price']) . ' TND</p>
                                        <p><strong>Contact Info:</strong> ' . htmlspecialchars($row['contact_info']) . '</p>
                                    </div>
                                </div>
                            </div>';
                        }
                
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<p>No events found.</p>';
                    }
                } catch (PDOException $e) {
                    echo 'Error fetching events: ' . $e->getMessage();
                }
                
                ?>    
                
            </div>
            <h3>Event Name</h3>
            <p>Event Details</p>
            <button class="btn btn-primary join-event" data-event-id="1">
                Join Event
            </button>
            <div id="participation-info-1" class="mt-4">
                <!-- Participation details will load here -->
            </div>
            <?php
              require_once '../../config/config.php';
              
              function getParticipationByEvent($id_event) {
                  $pdo = config::getConnexion();
                  $stmt = $pdo->prepare("SELECT * FROM participants WHERE id_event = :id_event");
                  $stmt->bindParam(':id_event', $id_event);
                  $stmt->execute();
                  return $stmt->fetchAll(PDO::FETCH_ASSOC);
              }

              // Add Participation
              function addParticipation($id_user, $id_event, $date_part, $nbr_ticket, $payed) {
                  $pdo = config::getConnexion();
                  $stmt = $pdo->prepare("
                      INSERT INTO participants (id_user, id_event, date_part, nbr_ticket, payed)
                      VALUES (:id_user, :id_event, :date_part, :nbr_ticket, :payed)
                  ");
                  $stmt->bindParam(':id_user', $id_user);
                  $stmt->bindParam(':id_event', $id_event);
                  $stmt->bindParam(':date_part', $date_part);
                  $stmt->bindParam(':nbr_ticket', $nbr_ticket);
                  $stmt->bindParam(':payed', $payed);
                  $stmt->execute();
                  return $pdo->lastInsertId();
              }

              $eventId = 1; 
              $participations = getParticipationByEvent($eventId);

              // 2. Add a participation record
              $newParticipation = addParticipation(123, 1, date('Y-m-d'), 2, 1); // Replace with dynamic values
              ?>
              
                
            <script>
                document.querySelectorAll(".join-event").forEach(button => {
                button.addEventListener("click", () => {
                    const eventId = button.getAttribute("data-event-id");
                    const userId = 123;
                    const tickets = 1; 

                    fetch("../../controler/particip.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        id_user: userId,
                        id_event: eventId,
                        nbr_ticket: tickets,
                        payed: 1 
                    })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                        document.getElementById(`participation-info-${eventId}`).innerHTML =
                            `<p>Successfully joined the event! Tickets: ${tickets}</p>`;
                        } else {
                        alert("Failed to join the event. Please try again.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
                });
                });
                </script>
                <script>
                    function highlightEvent(element) {
                        console.log("Event clicked:", element); // Debugging
                        document.querySelectorAll('.event-box').forEach(box => {
                            box.classList.remove('selected');
                        });
                        element.classList.add('selected');
                    }
                </script>

            <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center pagination-lg">
              <li class="page-item disabled">
                <a class="page-link">Previous</a>
              </li> 
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#">Next</a>
              </li>
            </ul>
          </nav>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Discover Tunisia. All rights reserved.</p>
    </footer>
</body>
</html>
