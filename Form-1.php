<div class="d-flex justify-content-center">
    <form action="envoyer-email.php" method="post" class="w-50">

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>

        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>

        <div class="form-group">
            <label for="email">Adresse e-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
        </div>

        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="check1" name="check1">
            <label class="form-check-label" for="check1">J'accepte les conditions générales</label>
        </div>

        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>