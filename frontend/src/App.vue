<script setup>

</script>

<template>
  <div class="min-h-[100vh] bg-gray-100">
    <header class="bg-gray-100">
      <router-link to="/" :class="['text-blue-500 hover:text-blue-400 mr-2', {'text-blue-300': $route.fullPath === '/'}]">
        Оборудование
      </router-link>

      <router-link to="/create" :class="['text-blue-500 hover:text-blue-400 mr-2', {'text-blue-300 hover:text-blue-300': $route.fullPath === '/create'}]">
        Добавить оборудование
      </router-link>

      <!--    <router-link to="/search" :class="['text-blue-500 hover:text-blue-400', {'text-blue-400': $route.fullPath === '/search'}]">-->
      <!--      Поиск-->
      <!--    </router-link>-->
    </header>

    <router-view />
  </div>
</template>

<style scoped>

</style>
