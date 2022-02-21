<?php global $wpdb ?>
<div class="flex full_page relative">
    <section id="cvEditor">
        <h1>Editez votre CV</h1>
        <div class="profil">
            <h2>Profil</h2>
            <form action="" method="post">
            <ul>
                <li class="cvNomInput">
                    <label for="nom">Nom : </label>
                    <input id="nom" name="nom" type="text" v-model="nomCv" v-on:change="autosave()">
                </li>
                <li class="cvPrenomInput">
                    <label for="prenom">Prénom : </label>
                    <input id="prenom" name="prenom" type="text" v-model="prenomCv" v-on:change="autosave()">
                </li>
                <li class="cvEmailInput">
                    <label for="email">Adresse e-mail : </label>
                    <input id="email" name="email" type="text" v-model="emailCv" v-on:change="autosave()">
                </li>
                <li class="cvPhoneInput">
                    <label for="phone">Numéro de téléphone : </label>
                    <input id="phone" name="phone" type="text" v-model="phoneCv" v-on:change="autosave()">
                </li>
                <li class="cvAdresseInput">
                    <label for="adresse">Adresse postale : </label>
                    <input id="adresse" name="adresse" type="text" v-model="adresseCv" v-on:change="autosave()">
                </li>
                <li class="cvPhotoInput">
                    <label for="photo">Photo : </label>
                    <input id="photo" name="photo" type="file" v-on:change="onChangePfp(); autosave()" accept="image/*">
                </li>
            </ul>
            </form>
        </div>
        <div class="experiences">
            <h2>Experiences</h2>
            <ul class="experienceList">
            </ul>
            <p id="experienceBtn">Ajouter une experience</p>
        </div>
        <div class="formations">
            <h2>Formations</h2>
            <ul class="formationList">
            </ul>
            <p id="formationBtn">Ajouter une formation</p>
        </div>
        <div class="langues">
            <h2>Langues parlées</h2>
            <ul class="langueList">
            </ul>
            <p id="langueBtn">Ajouter une langue parlée</p>
        </div>
        <button class="saveBtn">SAUVEGARDER</button>
    </section>
    <section id="cvVisualizer">
        <div class="fullCv relative flex">
            <div class="cvLeft">
                <div class="pfpCv" v-bind:style="{ backgroundImage: 'url(' + image + ')' }"></div>
                <ul>
                    <li>
                        <label for="nom">Nom : </label>
                        <span>{{ nomCv }}</span>
                    </li>
                    <li>
                        <label for="prenom">Prénom : </label>
                        <span>{{ prenomCv }}</span>
                    </li>
                    <li>
                        <label for="email">Adresse mail : </label>
                        <span>{{ emailCv }}</span>
                    </li>
                    <li>
                        <label for="phone">Numéro de téléphone : </label>
                        <span>{{ phoneCv }}</span>
                    </li>
                    <li>
                        <label for="adresse">Adresse : </label>
                        <span>{{ adresseCv }}</span>
                    </li>
                </ul>

                <div class="formations">
                    <h2>Formations</h2>
                    <ul class="formationListCv">

                    </ul>
                </div>
                <div class="langues">
                    <h2>Formations</h2>
                    <ul class="langueListCv">

                    </ul>
                </div>
            </div>
            <div class="cvRight">

                <div class="experiences">
                    <h2>Experiences</h2>
                    <ul class="experienceListCv">

                    </ul>
                </div>

            </div>
        </div>
    </section>









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
                    $langues  = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}langues", ARRAY_A );
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
</div>

