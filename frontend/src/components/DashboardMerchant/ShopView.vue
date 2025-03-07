<template>
    <v-row>
        <v-col cols="4">
            <h2> Editer ma boutique</h2>
            <v-form @submit.prevent="submitForm">
                <v-text-field v-model="name" type="text" name="name" label="Nom de la boutique"></v-text-field>
                <v-text-field v-model="logo" type="text" name="logo" label="Image de la boutique"></v-text-field>
                <v-select
                    v-model= "selectedType"
                    :items="shopTypes"
                    label="Type"
                    clearable
                    density="compact"
                    variant="outlined"
                ></v-select>
                <v-text-field v-model="address" type="text" name="address" label="Adresse"></v-text-field>
                <v-text-field v-model="phone" type="text" name="phone" label="téléphone"></v-text-field>
                <v-btn type="submit" color="primary">Valider</v-btn> <p color="success">{{ message }}</p>
            </v-form>
        </v-col>
        <v-col cols="8">
            <h2> Template</h2>
            <v-container>
                <v-row justify="center">
                    <v-col cols="12" md="8">
                    <v-card class="mx-auto">
                        <v-img :src="shop.logo" alt="Shop Logo" height="200px"></v-img>
                        <v-card-title class="headline">{{name}}</v-card-title>
                        <v-card-subtitle class="mb-2">{{selectedType}}</v-card-subtitle>
                        <v-card-text>
                        <v-divider class="my-3"></v-divider>
                        <v-list dense>
                            <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title><strong>Address:</strong> {{address}}</v-list-item-title>
                            </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title><strong>Phone:</strong> {{phone}}</v-list-item-title>
                            </v-list-item-content>
                            </v-list-item>
                        </v-list>
                        </v-card-text>
                    </v-card>
                    </v-col>
                </v-row>
                </v-container>
        </v-col>
    </v-row>
</template>

<script>

    export default{
        data(){
            return {
                shop: {},
                shopTypes: [],
                selectedType: null,
                logo: '',
                name: '',
                address: '',
                phone: '',
                type: '',
                message: ''
            };
        },
        methods: {
            getShop(){
                // Récupère les données de la boutique
                fetch('http://localhost:8000/api/shops/merchant/' + this.$route.params.id, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + this.$cookies.get('token'),
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    this.shop = data;
                    this.selectedType = data.type;
                    this.name = data.name;
                    this.logo = data.logo;
                    this.address = data.address;
                    this.phone = data.phone;
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
            },
            editShop(){
                const shopData = {
                    name: this.name,
                    logo: this.logo,
                    type: this.selectedType,
                    address: this.address,
                    phone: this.phone,
                };
                // Récupère les données de la boutique
                fetch('http://localhost:8000/api/shops/merchant/' + this.$route.params.id, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + this.$cookies.get('token'),
                    },
                    body: JSON.stringify(shopData)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    this.getShop();
                    this.message = "ok!";
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                });
            },
            submitForm(){
                this.editShop()
            }
        },
        mounted() {
            this.getShop();

            // Récupère les types de shops
            fetch('http://localhost:8000/shops-types', {
                method: 'GET',
                headers: {
                'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                this.shopTypes = data;
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation (type):', error);
            });
        },
        
    }

</script>