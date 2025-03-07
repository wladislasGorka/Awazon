<template>
    <v-container>
        <v-row>
            <v-col cols="12" sm="6" md="4">
                <v-card>
                    <v-card-title>Commerce</v-card-title>
                    <v-card-text>
                        <RouterLink :to="`/dashboard/${userID}/shop`"><v-btn>Voir sa fiche commerce</v-btn></RouterLink>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col cols="12" sm="6" md="4">
                <v-card>
                    <v-card-title>Produits</v-card-title>
                    <v-card-text>
                        <RouterLink :to="`/dashboard/${userID}/products`"><v-btn>Gestion des produits</v-btn></RouterLink>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col cols="12" sm="6" md="4">
                <v-card>
                    <v-card-title>Evenements</v-card-title>
                    <v-card-text>
                        <v-btn>Gestion des événements</v-btn>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col cols="12" sm="6" md="4">
                <v-card>
                    <v-card-title>Promotions</v-card-title>
                    <v-card-text>
                        <v-btn>Gestion des promotions</v-btn>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col cols="12" sm="6" md="4">
                <v-card>
                    <v-card-title>Commandes</v-card-title>
                    <v-card-text>
                        <v-btn>Gestion des commandes</v-btn>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col cols="12" sm="6" md="4">
                <v-card>
                    <v-card-title>Statistiques</v-card-title>
                    <v-card-text>
                        <v-btn>Voir les statistiques</v-btn>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>

    export default {
        name: 'DashboardMerchantView',
        data() {
            return {
                userID: this.$cookies.get('user').id,
            }
        },
    };

</script>