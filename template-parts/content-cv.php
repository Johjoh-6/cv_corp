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
        <div class="skills">
            <h2>Compétences et savoir-être possédés</h2>
            <ul class="skillList">
            </ul>
            <p id="skillBtn">Ajouter une compétence/un savoir-être</p>
        </div>
        <div class="hobbies">
            <h2>Loisirs</h2>
            <ul class="hobbyList">
            </ul>
            <p id="hobbyBtn" >Ajouter un loisir pratiqué</p>
        </div>
        <button class="saveBtn">SAUVEGARDER</button>
    </section>



    <section id="cvVisualizer">
        <div class="fullCv relative flex">
            <div class="cvLeft">
                <div class="pfpCv" v-bind:style="{ backgroundImage: 'url(' + image + ')' }"></div>
                <ul class="info-cv">
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
                        <label for="adresse">Adresse postal : </label>
                        <span>{{ adresseCv }}</span>
                    </li>
                </ul>

                <div class="formations">
                    <h2>Formations</h2>
                    <ul class="formationListCv">

                    </ul>
                </div>
                <div class="langues">
                    <h2>Langues</h2>
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

                <div class="skills">
                    <h2>Compétences et savoir-être</h2>
                    <ul class="skillListCv">
                    </ul>
                </div>

                <div class="hobbies">
                    <h2>Loisirs</h2>
                    <ul class="hobbyListCv">

                    </ul>
                </div>

            </div>
        </div>
    </section>


    <?php include_once 'inc/cv-modales.php' ?>
</div>

