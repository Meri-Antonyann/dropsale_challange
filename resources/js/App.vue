<template>
    <div class="card text-center">
        <div class="card-body w-50 d-flex justify-content-center align-items-center">
            <div>
                <button class="btn btn-primary" @click="importUsers">Import Users</button>
            </div>
             <div class="ml-2">
                <p class="fw-bold">Total</p>
            </div>
            <div class="ml-2">
                <p class="fw-bold">Added</p>
            </div>
            <div class="ml-2">
                <p class="fw-bold">Updated</p>
            </div>
        </div>
        
    </div>

</template>

<script>
export default {
   name: "PartnerLocator",
    data() {
        return {
            users: []
        }
    },
    computed: {
     
    },
    mounted(){
    },
    methods:{
        async importUsers(){
            console.log("ok");
            await this.axios.get('https://randomuser.me/api/?results=5000')
                .then(response => {
                    this.users = response.data.results;
                    console.log(this.users, "11111111")

                this.axios.post('users', this.users )
                    .then(response => {
                    console.log('Users sent to the backend:', response.data);
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