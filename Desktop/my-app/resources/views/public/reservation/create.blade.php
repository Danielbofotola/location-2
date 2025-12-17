<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('asset/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ url('asset/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('asset/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('asset/css/style.css') }}">

    <title>Réservation</title>
  </head>
  <body>
  <div class="content">
    <div class="px-5">
      <div class="row">
        <div class="col-md-5 order-md-2">
          <img src="{{ url('asset/images/Sans titre - 2.png') }}" alt="Image" class="img-fluid">
        </div>

        <div class="col-md-7 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
                <h3><strong>Réservations</strong></h3>
                <p class="mb-4 font-weight-bolder text-dark">Location 150$/par heure</p>
              </div>

              <!-- Formulaire de réservation -->
              <form action="{{ route('reservation.store') }}" method="POST">
                @csrf
                <div class="row gap-2">
                  <div class="form-group first col-md-6">
                    <label for="nom" class="text-dark">Nom</label>
                    <input type="text" class="form-control border rounded px-3" name="nom" id="nom" required>
                  </div>

                  <div class="form-group first col-md-6">
                    <label for="prenom">Prénom</label>
                    <input type="text" class="form-control border rounded px-3" name="prenom" id="prenom" required>
                  </div>

                  <div class="form-group first col-md-6">
                    <label for="numero_telephone">Numéro de téléphone</label>
                    <input type="text" class="form-control border rounded px-3" name="numero_telephone" id="numero_telephone" required>
                  </div>

                  <div class="form-group first col-md-6">
                    <label for="date">Date</label>
                    <input type="date" class="form-control border rounded px-3" name="date" id="date" required>
                  </div>

                  <div class="form-group first col-md-6">
                    <label for="heure_debut">Heure de début</label>
                    <input type="time" class="form-control border rounded px-3" name="heure_debut" id="heureDebut" min="08:00" max="16:00" required>
                  </div>

                  <div class="form-group first col-md-6">
                    <label for="heure_fin">Heure de fin</label>
                    <input type="time" class="form-control border rounded px-3" name="heure_fin" id="heureFin" min="08:00" max="16:00" required>
                  </div>

                  <div class="form-group first col-md-6">
                    <label for="nombre_participants">Nombre de participants</label>
                    <input type="number" class="form-control border rounded px-3" name="nombre_participants" min="1" required>
                  </div>

                  <div class="form-group first col-md-6">
                    <label for="total">Prix total</label>
                    <input type="text" class="form-control border rounded px-3" id="prixTotal" readonly>
                    <input type="hidden" name="total" id="prixTotalHidden">
                  </div>
                </div>

                <input type="submit" value="Pré-réserver" class="btn text-white btn-block btn-dark">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    const PRIX_PAR_HEURE = 150;
    const heureDebut = document.getElementById("heureDebut");
    const heureFin = document.getElementById("heureFin");
    const prixTotal = document.getElementById("prixTotal");
    const prixTotalHidden = document.getElementById("prixTotalHidden");

    function calculerPrix() {
      if (!heureDebut.value || !heureFin.value) {
        prixTotal.value = "";
        prixTotalHidden.value = "";
        return;
      }

      const debut = new Date(`1970-01-01T${heureDebut.value}:00`);
      const fin = new Date(`1970-01-01T${heureFin.value}:00`);

      if (fin <= debut) {
        alert("L'heure de fin doit être supérieure à l'heure de début.");
        heureFin.value = "";
        prixTotal.value = "";
        prixTotalHidden.value = "";
        return;
      }

      const heures = (fin - debut) / (1000 * 60 * 60);
      const total = (heures * PRIX_PAR_HEURE).toFixed(2);

      prixTotal.value = total;
      prixTotalHidden.value = total;
    }

    heureDebut.addEventListener("change", calculerPrix);
    heureFin.addEventListener("change", calculerPrix);
  </script>

  <script src="{{ url('asset/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ url('asset/js/popper.min.js') }}"></script>
  <script src="{{ url('asset/js/bootstrap.min.js') }}"></script>
  <script src="{{ url('asset/js/main.js') }}"></script>
  </body>
</html>
