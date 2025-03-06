<template>
    <v-btn color="primary" @click="overlayAdd = !overlayAdd"> Ajouter un produit </v-btn>
    <v-overlay
        v-model="overlayAdd"
        class="align-center justify-center"
        contained
    >
        <v-card>
            <v-card-title>Ajouter un produit</v-card-title>
            <v-form @submit.prevent="submitForm">
                <v-card-text>                
                        <v-text-field v-model="name" type="text" name="name" label="Nom" ></v-text-field>
                        <v-text-field v-model="description" type="text" name="description" label="Description" ></v-text-field>
                        <v-text-field v-model="price" type="number" step="0.01" name="price" label="Prix" ></v-text-field>                
                </v-card-text>
                <v-btn type="submit" color="success" @click="overlayAdd = false" > Ajouter </v-btn>
            </v-form>            
        </v-card>        
    </v-overlay>
    <v-table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody v-if="products.length > 0">
            <tr v-for="product in products" :key="product.id">
                <td>{{ product.name }}</td>
                <td>{{ product.description }}</td>
                <td>{{ product.price }}</td>
                <td>{{ product.stock }}</td>

                <td>
                    <v-btn color="primary" @click="openEditOverlay(product)"> Modifier </v-btn>
                    <v-overlay
                        v-model="overlayEdit"
                        class="align-center justify-center"
                        contained
                    >
                        <v-card>
                            <v-card-title>Modifier un produit</v-card-title>
                                <v-card-text>                
                                        <v-text-field v-model="name" type="text" name="name" label="Nom"></v-text-field>
                                        <v-text-field v-model="description" type="text" name="description" label="description"></v-text-field>
                                        <v-text-field v-model="price" type="number" step="0.01" name="price" label="price"></v-text-field>                
                                        <v-text-field v-model="stock" type="texte" name="stock" label="stock"></v-text-field>                
                                </v-card-text>
                                <v-btn type="submit" color="success" @click="editProduct(selectedProduct.id)" > Editer </v-btn>
                        </v-card>        
                    </v-overlay>
                    
                    <v-btn color="error" @click="openDeleteOverlay(product)">Supprimer</v-btn>
                    <v-overlay
                        v-model="overlayDelete"
                        class="align-center justify-center"
                        contained
                    >
                        <v-card>
                            <v-card-title>Supprimer un produit</v-card-title>
                            <v-btn type="submit" color="error" @click="deleteProduct(selectedProduct.id)" > Confirmer </v-btn>     
                        </v-card>        
                    </v-overlay>
                </td>
            </tr>
        </tbody>
        <tbody v-else>
            <tr>
                <td colspan="4">Aucun produit</td>
            </tr>
        </tbody>
    </v-table>
</template>

<script>

    export default {
        name: 'MerchantProductsView',
        data() {
            return {
                products: [],
                overlayAdd: false,
                overlayEdit: false,
                overlayDelete: false,
                name: '',
                description: '',
                price: '',
                stock: '',
                selectedProduct: null,
            }
        },
        mounted() {
            this.getProducts();
        },
        methods: {
            getProducts() {
                fetch('http://localhost:8000/products/merchant/' + this.$cookies.get('user').id)
                    .then(response => response.json())
                    .then(data => this.products = data);
            },
            openEditOverlay(product) {
                this.selectedProduct = product;
                this.name = product.name;
                this.description = product.description;
                this.price = product.price;
                this.stock = product.stock;
                this.overlayEdit = true;
            },
            editProduct(id){
                const productData = {
                    id: id,
                    name: this.name,
                    description: this.description,
                    price: this.price,
                    stock: this.stock,
                };
                this.overlayEdit = false;
                console.log(productData);
                fetch('http://localhost:8000/api/products/' + id, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + this.$cookies.get('token'),
                    },
                    body: JSON.stringify(productData)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    this.getProducts();
                })
            },
            openDeleteOverlay(product) {
                this.selectedProduct = product;
                this.overlayDelete = true;
            },
            deleteProduct(id){
                this.overlayDelete = false;
                fetch('http://localhost:8000/api/products/' + id, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': 'Bearer ' + this.$cookies.get('token'),
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    this.getProducts();
                })
            },
            submitForm() {
                const productData = {
                    name: this.name,
                    description: this.description,
                    price: this.price,
                    merchant: this.$cookies.get('user').id,
                };
                fetch('http://localhost:8000/api/products/create', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + this.$cookies.get('token'),
                    },
                    body: JSON.stringify(productData)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    this.getProducts();
                })
            }
        }
    };

</script>