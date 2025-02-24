<template>
    <v-data-table :items="items"></v-data-table>
</template>

<script>
    export default {
        data() {
            return {
                items: []
            }
        },

        mounted() {
            fetch('http://localhost:8000/users', {
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
                    console.log('List of users:', data);
                    this.items = data.datas;
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                })
        }
    }
    

    
</script>