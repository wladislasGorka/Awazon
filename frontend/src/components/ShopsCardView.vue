<template>
    <v-card width="200" min-height="200" class="mx-auto">
      <v-card-title>        
        <v-row>
          <v-col cols="12">
            <h1 class="display-2 text-subtitle-2 mb-3">
                {{ shop.name }}
            </h1>
          </v-col>
        </v-row>
      </v-card-title>
      <v-card-text>
        <v-row>
            <v-col cols="12">
                <v-row>
                  <v-col cols="12">
                    <p class="display-2 text-subtitle-1 mb-3">
                      {{ shop.address }}
                    </p>
                    <p>
                      {{ shop.type }}
                    </p>
                  </v-col>
                </v-row>
            </v-col>
        </v-row>
      </v-card-text>
    </v-card>
</template>

<script>
    export default {
    name: 'ShopsCardView',
    props: {
        shop: Object
    }
    };
</script>