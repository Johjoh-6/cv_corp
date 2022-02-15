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
    </section>
    <section id="cvVisualizer">
        <div class="fullCv relative">
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
        </div>
    </section>
    <section class="cvModale dNone experienceModale absolute">
        <ul>
            <li class="cvNomInput">
                <label for="entreprise">Entreprise : </label>
                <input id="entreprise" name="entreprise" type="text">
            </li>
            <li>
                <label for="job">Position : </label>
                <input id="job" name="job" type="text">
            </li>
            <li>
                <span id="experienceAdd">Ajouter une experience</span>
            </li>
        </ul>

    </section>
</div>

