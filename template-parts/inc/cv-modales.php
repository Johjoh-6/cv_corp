
<section class="cvModale dNone experienceModale absolute">
    <ul>
        <li>
            <label for="entreprise">Entreprise : </label>
            <input id="entreprise" name="entreprise" type="text">
        </li>
        <li>
            <label for="job">Position : </label>
            <input id="job" name="job" type="text">
        </li>
        <li class="flex">
            <div>
                <label for="expStart">Année de début : </label>
                <select name="expStart" id="expStart">
                    <?php for($i = 1900; $i <= date("Y"); $i++) { ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php } ?>
                </select>
                <!-- /# -->
            </div>
            <div>
                <label for="expEnd">Année de fin : </label>
                <select name="expEnd" id="expEnd">
                    <option value="present">Présent</option>
                    <?php for($i = 1900; $i <= date("Y"); $i++) { ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php } ?>
                </select>
            </div>
        </li>
        <li>
            <label for="expDetails">Détails de l'expérience</label>
            <textarea name="expDetails" id="expDetails" cols="20" rows="5"></textarea>
            <!-- /# -->
        </li>
        <li>
            <span id="experienceAdd">Ajouter une experience</span>
        </li>
    </ul>

</section>
<section class="cvModale dNone formationModale absolute">
    <ul>
        <li>
            <label for="organisme">Organisme de formation : </label>
            <input id="organisme" name="organisme" type="text">
        </li>
        <li>
            <label for="nomFormation">Nom de la formation : </label>
            <input id="nomFormation" name="nomFormation" type="text">
        </li>
        <li>
            <label for="formLieu">Lieu de formation : </label>
            <input id="formLieu" name="formLieu" type="text">
        </li>
        <li class="flex">
            <div>
                <label for="formStart">Année de début : </label>
                <select name="formStart" id="formStart">
                    <?php for($i = 1900; $i <= date("Y"); $i++) { ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php } ?>
                </select>
                <!-- /# -->
            </div>
            <div>
                <label for="formEnd">Année de fin : </label>
                <select name="formEnd" id="formEnd">
                    <option value="present">Présent</option>
                    <?php for($i = 1900; $i <= date("Y"); $i++) { ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php } ?>
                </select>
            </div>
        </li>
        <li>
            <label for="formDetails">Détails de la formation</label>
            <textarea name="formDetails" id="formDetails" cols="20" rows="5"></textarea>
            <!-- /# -->
        </li>
        <li>
            <span id="formationAdd">Ajouter une formation</span>
        </li>
    </ul>

</section>

<section class="cvModale dNone langueModale absolute">
    <ul>
        <li>
            <label for="langue">Langue : </label>
            <select name="langue" class="langue">
                <option value=""></option>
                <?php
                $langues  = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}langues WHERE `shows_up_in_select` = 1", ARRAY_A );
                foreach ($langues as $langue) {
                    ?> <option value="<?= $langue['id'] ?>"><?= $langue['langue_name'] ?></option>
                <?php }
                ?>
            </select>
            <input class="langue" name="langue" type="text">
        </li>
        <li class="flex">
            <div>
                <label for="niveauLangue">Niveau : </label>
                <select name="niveauLangue" id="niveauLangue">
                    <option value="1">1 (débutant)</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5 (parlé couramment)</option>
                </select>
            </div>
        </li>
        <li>
            <span id="langueAdd">Ajouter une langue</span>
        </li>
    </ul>
</section>

<section class="cvModale dNone hobbyModale absolute">
    <ul>
        <li>
            <label for="hobby">Loisir : </label>
            <input class="hobby" name="hobby" type="text">
        </li>
        <li>
            <label for="hobbyDetails">Details : </label>
            <textarea name="hobbyDetails" id="hobbyDetails" cols="20" rows="5"></textarea>
        </li>
        <li>
            <span id="hobbyAdd">Ajouter une loisir</span>
        </li>
    </ul>

</section>


<section class="cvModale dNone skillModale absolute">
    <ul>
        <li>
            <label for="skill">Compétence : </label>
            <select name="skill" class="skill">
                <option value=""></option>
                <?php
                $skills  = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}skills WHERE `shows_up_in_select` = 1", ARRAY_A );
                foreach ($skills as $skill) {
                    ?> <option value="<?= $skill['id'] ?>"><?= $skill['skill_name'] ?></option>
                <?php }
                ?>
            </select>
            <input class="skill" name="skill" type="text">
        </li>
        <li class="flex">
            <div>
                <label for="niveauSkill">Niveau : </label>
                <select name="niveauSkill" id="niveauSkill">
                    <option value=""></option>
                    <option value="1">1 (débutant)</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5 (maîtrisé avec aisance)</option>
                </select>
            </div>
        </li>
        <li>
            <span id="skillAdd">Ajouter une compétence</span>
        </li>
    </ul>
</section>