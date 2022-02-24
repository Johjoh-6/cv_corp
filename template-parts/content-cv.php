<?php
$id_user = get_current_user_id();
$meta_user = get_user_meta($id_user);
?>
<div class="flex full_page relative">
    <section id="cvEditor">
        <h1>Editez votre CV</h1>
        <div class="profil">
            <h2>Profil</h2>
            <form action="" method="post">
            <ul>
                <li class="cvTitleInput">
                    <label for="title">Titre du CV : </label>
                    <input id="title" name="title" type="text" v-model="titleCv" v-on:change="setTitle(); autosave()">
                </li>
                <li class="cvNomInput">
                    <label for="nom">Nom : </label>
                    <input id="nom" name="nom" type="text" v-model="nomCv" v-on:change="setNom(); autosave()">
                </li>
                <li class="cvPrenomInput">
                    <label for="prenom">Prénom : </label>
                    <input id="prenom" name="prenom" type="text" v-model="prenomCv" v-on:change="setPrenom(); autosave()">
                </li>
                <li class="cvEmailInput">
                    <label for="email">Adresse e-mail : </label>
                    <input id="email" name="email" type="text" v-model="emailCv" v-on:change="setEmail(); autosave()">
                </li>
                <li class="cvPhoneInput">
                    <label for="phone">Numéro de téléphone : </label>
                    <input id="phone" name="phone" type="text" v-model="phoneCv" v-on:change="setPhone(); autosave()">
                </li>
                <li class="cvAdresseInput">
                    <label for="adresse">Adresse postale : </label>
                    <input id="adresse" name="adresse" type="text" v-model="adresseCv" v-on:change="setAdresse(); autosave()">
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
                <?php if(is_user_logged_in() AND !empty($meta_user['img'][0])) { ?>
                <img class="pfpCv" src="<?= wp_get_attachment_url($meta_user['img'][0]) ?>" alt="">
                <?php } ?>
                <ul>
                    <li>
                        <h2>{{ titleCv }}</h2>
                    </li>
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

