<template>
    <v-table>
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Date de création</th>
                <th>Date de retrait</th>
                <th>Statut</th>
                <th></th>
            </tr>
        </thead>
        <tbody v-if="orders.length > 0">
            <tr v-for="order in orders" :key="order['order'].id">
                <td>{{ order['order'].number }}</td>
                <td>{{ order['order'].creationDate }}</td>
                <td>{{ order['order'].pickupDate }}</td>
                <td>{{ order['orderStatus'] }}</td>
                <td>
                    <v-btn @click="openOverlay(order['order'].id)">Voir</v-btn>
                </td>
            </tr>
        </tbody>
        <tbody v-else>
            <tr>
                <td colspan="4">Aucune commande</td>
            </tr>
        </tbody>
    </v-table>
    <v-overlay
        v-model="overlayDetails"
        class="align-center justify-center"
        contained
    >
        <v-card>
            <v-card-title>Détail de la commande</v-card-title>
                <v-card-text>                
                    <v-table>
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Quantité</th>
                                <th>Prix unitaire</th>
                                <th>Prix total</th>
                            </tr>
                        </thead>
                        <tbody v-if="products.length > 0">
                            <tr v-for="product in products.filter( p => p.orderId === selectedOrder)" :key="product.id">
                                <td>{{ product.name }}</td>
                                <td>{{ product.quantity }}</td>
                                <td>{{ product.price }}</td>
                                <td>{{ product.total_price }}</td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td colspan="4">Aucun produit</td>
                            </tr>
                        </tbody>                        
                    </v-table>               
                </v-card-text>
                <v-select
                    v-model= "selectedStatus"
                    :items="status"
                    label="Statuts"
                    density="compact"
                    variant="outlined"
                ></v-select>
                <v-btn type="submit" color="success" @click="editOrder(selectedOrder)" > Editer </v-btn>
        </v-card>        
    </v-overlay>
</template>

<script>


    export default {
        name: 'MerchantOrdersView',
        data() {
            return {
                orders: [],
                products: [],
                status: [],
                filterStatus: 'Annulée',
                overlayDetails: false,
                selectedOrder: '',
                selectedStatus: '',
                
            }
        },
        computed: {
            filteredOrders() {
                console.log(this.filterStatus)
                return this.orders.filter(order => {order['orderStatus'] === this.filterStatus; console.log(order.status)})
            }
        },
        methods: {
            getOrders() {
                fetch('http://localhost:8000/api/orders/merchant/' + this.$cookies.get('user').id, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + this.$cookies.get('token'),
                    }
                })
                .then(response => response.json())
                .then(data => {
                    this.orders = data['orders'];
                    this.products = data['products'];
                    //console.log(this.orders[0]['order'].number);
                    //console.log(this.orders[0]['orderStatus']);
                    //console.log(this.products[0].orderId);
                });
            },
            editOrder(id){
                const OrderData = {
                    id: id,
                    userId: this.$cookies.get('user').id,
                    status: this.selectedStatus,
                };
                console.log(OrderData);
                fetch('http://localhost:8000/api/order/update', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + this.$cookies.get('token'),
                    },
                    body: JSON.stringify(OrderData)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    this.overlayDetails = false;
                    this.getOrders();
                })
            },
            openOverlay(id){
                this.selectedOrder = id;
                console.log(this.selectedOrder);
                this.overlayDetails = true;
            }
        },     
        mounted() {
            this.getOrders();
            //Récupère les statuts possible des commandes
            fetch('http://localhost:8000/api/ordersStatus', {
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
                Object.values(data).forEach(status => this.status.push(status))
                console.log(this.status);
                this.selectedStatus = data[0];
                
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation (type):', error);
            });
        },
    };

</script>