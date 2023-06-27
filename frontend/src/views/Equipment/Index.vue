<template>
  <section class="bg-gray-100 dark:bg-gray-900">
    <div class="container px-6 py-10 mx-auto">
      <h1 class="text-3xl font-semibold text-gray-800 lg:text-4xl dark:text-white">Список оборудования</h1>

      <!-- This is an example component -->
      <div class="mt-4">
        <div class="pt-2 relative mx-auto text-gray-600">
          <input
            class="border-2 border-gray-300 bg-white w-full h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
            type="search"
            name="search"
            placeholder="Search"
            v-model="searchTerm"
          >
          <button
            type="submit"
            class="absolute right-0 top-0 mt-5 mr-4"
            @click="handleSearch"
          >
            <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                 viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                 width="512px" height="512px">
            <path
                d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
          </svg>
          </button>
        </div>
      </div>

      <div class="grid grid-cols-1 gap-8 mt-8 md:mt-16 md:grid-cols-2" v-if="equipments && equipments.length">

        <div class="lg:flex relative" v-for="equipment in equipments" :key="equipment.id">
          <router-link
              @click="HANDLE_EDIT_BTN_CLICK(equipment)"
              class="absolute top-0 right-0 h-[20px] w-[20px] hover:opacity-60 cursor-pointer"
              :to="`/edit/:${equipment.id}`"
          >
            <svg width="100%" height="100%" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g id="Edit / Edit_Pencil_Line_01">
                <path id="Vector" d="M4 20.0001H20M4 20.0001V16.0001L12 8.00012M4 20.0001L8 20.0001L16 12.0001M12 8.00012L14.8686 5.13146L14.8704 5.12976C15.2652 4.73488 15.463 4.53709 15.691 4.46301C15.8919 4.39775 16.1082 4.39775 16.3091 4.46301C16.5369 4.53704 16.7345 4.7346 17.1288 5.12892L18.8686 6.86872C19.2646 7.26474 19.4627 7.46284 19.5369 7.69117C19.6022 7.89201 19.6021 8.10835 19.5369 8.3092C19.4628 8.53736 19.265 8.73516 18.8695 9.13061L18.8686 9.13146L16 12.0001M12 8.00012L16 12.0001" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </g>
            </svg>
          </router-link>

          <img class="object-cover w-full h-56 rounded-lg lg:w-64" src="https://images.unsplash.com/photo-1515378960530-7c0da6231fb1?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" alt="">

          <div class="flex flex-col justify-between py-6 lg:mx-6">
            <div class="flex flex-col">
              <span class="text-xl font-semibold text-gray-800 dark:text-white">Маска</span>
              <a href="#" class="text-xl font-semibold text-gray-800 hover:underline dark:text-white ">
                {{equipment.equipment_type?.mask}}
              </a>
            </div>

            <div>
              {{equipment?.desc}}
            </div>

            <div class="flex flex-col">
              <span class="text-sm text-gray-500 dark:text-gray-300">Номер</span>
              <span class="text-sm text-gray-500 dark:text-gray-300">{{ equipment.serial_number }}</span>
            </div>
          </div>
        </div>

<!--        <div class="lg:flex">-->
<!--          <img class="object-cover w-full h-56 rounded-lg lg:w-64" src="https://images.unsplash.com/photo-1497032628192-86f99bcd76bc?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" alt="">-->

<!--          <div class="flex flex-col justify-between py-6 lg:mx-6">-->
<!--            <a href="#" class="text-xl font-semibold text-gray-800 hover:underline dark:text-white ">-->
<!--              How to use sticky note for problem solving-->
<!--            </a>-->

<!--            <span class="text-sm text-gray-500 dark:text-gray-300">On: 20 October 2019</span>-->
<!--          </div>-->
<!--        </div>-->

<!--        <div class="lg:flex">-->
<!--          <img class="object-cover w-full h-56 rounded-lg lg:w-64" src="https://images.unsplash.com/photo-1544654803-b69140b285a1?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" alt="">-->

<!--          <div class="flex flex-col justify-between py-6 lg:mx-6">-->
<!--            <a href="#" class="text-xl font-semibold text-gray-800 hover:underline dark:text-white ">-->
<!--              Morning routine to boost your mood-->
<!--            </a>-->

<!--            <span class="text-sm text-gray-500 dark:text-gray-300">On: 25 November 2020</span>-->
<!--          </div>-->
<!--        </div>-->

<!--        <div class="lg:flex">-->
<!--          <img class="object-cover w-full h-56 rounded-lg lg:w-64" src="https://images.unsplash.com/photo-1530099486328-e021101a494a?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1547&q=80" alt="">-->

<!--          <div class="flex flex-col justify-between py-6 lg:mx-6">-->
<!--            <a href="#" class="text-xl font-semibold text-gray-800 hover:underline dark:text-white ">-->
<!--              All the features you want to know-->
<!--            </a>-->

<!--            <span class="text-sm text-gray-500 dark:text-gray-300">On: 30 September 2020</span>-->
<!--          </div>-->
<!--        </div>-->

<!--        <div class="lg:flex">-->
<!--          <img class="object-cover w-full h-56 rounded-lg lg:w-64" src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1484&q=80" alt="">-->

<!--          <div class="flex flex-col justify-between py-6 lg:mx-6">-->
<!--            <a href="#" class="text-xl font-semibold text-gray-800 hover:underline dark:text-white ">-->
<!--              Minimal workspace for your inspirations-->
<!--            </a>-->

<!--            <span class="text-sm text-gray-500 dark:text-gray-300">On: 13 October 2019</span>-->
<!--          </div>-->
<!--        </div>-->

<!--        <div class="lg:flex">-->
<!--          <img class="object-cover w-full h-56 rounded-lg lg:w-64" src="https://images.unsplash.com/photo-1624996379697-f01d168b1a52?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" alt="">-->

<!--          <div class="flex flex-col justify-between py-6 lg:mx-6">-->
<!--            <a href="#" class="text-xl font-semibold text-gray-800 hover:underline dark:text-white ">-->
<!--              What do you want to know about Blockchane-->
<!--            </a>-->

<!--            <span class="text-sm text-gray-500 dark:text-gray-300">On: 20 October 2019</span>-->
<!--          </div>-->
<!--        </div>-->
      </div>

      <div v-else class="flex justify-between items-center text-6xl">
        Список пуст
      </div>
    </div>
  </section>
</template>

<script>
import {ApiInstance} from "../../utils/instance.js";
import {mapActions} from "vuex";

export default {
  name: "Index",
  data() {
    return {
      equipments: [],
      searchTerm: ""
    }
  },
  methods: {
    ...mapActions(['HANDLE_EDIT_BTN_CLICK']),
    async fetchEquipments(q = null) {
      try {
        const {data} = await ApiInstance.get('/equipment', {params: {q: q}})
        this.equipments = data.data
      } catch (e) {
        alert(e?.message ?? e)
      }
    },
    async handleSearch() {
      try {
        await this.fetchEquipments(this.searchTerm)
      } catch (e) {
        alert(e?.message ?? e)
      }
}
  },
  created () {
    this.fetchEquipments()
  }
}
</script>

<style scoped>

</style>