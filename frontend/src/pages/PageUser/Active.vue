<template>
    
</template>
<script>
import axios from 'axios';
export default {
    props: ['hash'],
    data() {
        return {
            hash: this.$route.params.hash,
            error: null,
            success: null,
        };
    },
    mounted() {
        axios.get('http://127.0.0.1:8000/api/activate/' + this.hash)
            .then((res) => {
                this.$router.push('/login');
            })
            .catch(error => {
                this.$router.push('/login');
            });
    },
}   
</script>
<style>
    
</style>