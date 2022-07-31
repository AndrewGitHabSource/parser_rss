<template>
    <div class="container">
        <h2>{{title}}</h2>

    </div>
</template>

<script>
import { inject, reactive, computed, onMounted, ref, watch } from "vue";

export default {
    props: {
        post: { type: Object, required: false },
    },
    setup(props) {
        let title = ref("Edit");

        return {
            title,
        }
    }
}
</script>

<style scoped>

</style>
