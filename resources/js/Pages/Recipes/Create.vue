<template>
    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form @submit.prevent="recipeStore">
                <input v-model="title" type="text" placeholder="Le nom de votre recette" class="rounded-lg border border-gray-200 w-full p-2 font-semibold resize-none focus:outline-none">
                <textarea v-model="desc" placeholder="Décrivez les étapes de la recette" class="rounded-lg border border-gray-200 w-full p-2 font-semibold resize-none focus:outline-none"></textarea>
                <textarea v-model="ingredients" placeholder="Listez les ingrédients" class="rounded-lg border border-gray-200 w-full p-2 font-semibold resize-none focus:outline-none"></textarea>
                <span class="my-5 text-red-500" v-if="$page.errors">
                    {{$page.errors}}

                </span>
                <div class="flex items-center space-x-4 justify-end mt-3">
                    <button-vue class="bg-blue-500 hover:bg-blue-800 rounded-full font-extrabold">Publier</button-vue>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import Button from '../../Jetstream/Button.vue'
    import Input from '../../Jetstream/Input.vue'

    export default {

    components: {
        ButtonVue: Button
    },
    data(){
        return{
            desc : '',
            title : '',
            ingredients : ''
        }
    },
    methods:{
        recipeStore(){
            this.$inertia.post('recipes', {
                title : this.title,
                desc : this.desc,
                ingredients : this.ingredients
            }, {preserveState : false})
        }
    },
    Input    }
</script>

<style scoped>
    button:disabled {
        opacity: 50%;
        cursor: not-allowed;
    }
</style>
