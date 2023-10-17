<template>
     <div class="card text-center">
        <div class="card-body mx-auto my-auto w-50 d-flex justify-content-center align-items-center">
            <div>
                <button class="btn btn-success" @click="importUsers">Import Users</button>
            </div>
             <div class="ml-4 d-flex">
                <p>Total:</p>
                <p class="font-weight-bold ml-2">{{ usersCountData.total ?? '' }}</p>
            </div>
            <div class="ml-4 d-flex">
                <p>Added</p>
                <p class="font-weight-bold ml-2">{{ usersCountData.created ?? '' }}</p>
            </div>
            <div class="ml-4 d-flex">
                <p>Updated</p>
                <p class="font-weight-bold ml-2">{{ usersCountData.updated ?? '' }}</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PartnerLocator",
        data() {
            return {
                users: [],
                usersCountData: ''
            }
        },
        mounted(){
            this.handleUsersData();
        },
        methods:{

            async handleUsersData(){
                await this.axios.get('/api/users')
                    .then(response => {
                        console.log(response);
                        this.usersCountData = response.data.data;
                    })
                    .catch(error => {
                        console.error('Error fetching users:', error);
                    });
            },

            async importUsers(){
                await this.axios.get('https://randomuser.me/api/?results=5000')
                    .then(response => {
                    
                    this.axios.post('/api/users', { users:  JSON.stringify(response.data.results) }, {
                        headers: {'Content-Type': 'application/json'}} )
                        .then(response => {
                            this.usersCountData = response.data.data.result;
                        })
                        .catch(error => {
                            console.error('Error sending users to the backend:', error);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching users:', error);
                    });
            },
        }
    }
</script>