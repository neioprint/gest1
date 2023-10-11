<div>
    <div class="input-container">
        <label for="nombre">Nombre d'imprimés à commander</label>

        <input type="number" name="nombre" class="input" min="1" max="3" step="1" placeholder="1" required />
        <span>Nombre d'imprimés à commander</span>

    </div>


    <label for="commande"></label>
    <select name="commande" id="commande" class="input" required style="background:#593196">
        <option value="">Choisissez votre imprimé</option>
        <option value="carte de visite">Carte de Visite</option>
        <option value="carte de visite">Etiquette couché</option>
        <option value="carte de visite">Etiquette autocollant</option>

        <option value="Fiche de pointage">Fiche de Pointage</option>
        <option value="Bon de chargement">Bon de chargement</option>
        <option value="carte de visite">Carte de Visite</option>
        <option value="Fiche de pointage">Fiche de pointage</option>
        <option value="Bon de chargement">Bon de chargement</option>
        <option value="Bon de chargement">Bon de chargement</option>
        <option value="carte de visite">Carte de Visite</option>
        <option value="Fiche de pointage">Fiche de pointage</option>
        <option value="Bon de chargement">Bon de chargement</option>

        <option value="calendrier">Calendrier</option>
    </select>
</div>
<div class="input-container">
    <label for="quantite">Quantité à partir de 500</label>
    <input type="number" name="quantite" class="input" min="500" step="250" max="900000" required />
    <span>Quantité à partir de 500</span>
    <!--   <select name="quantite" id="quantite" required>
        <option value="1000">1000</option>
        <option selected value="2000">2000</option>
    </select> -->
</div>