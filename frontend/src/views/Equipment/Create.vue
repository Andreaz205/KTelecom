<template>
  <div class="min-h-screen p-6 bg-gray-100 flex items-center justify-center">
    <div class="container max-w-screen-lg mx-auto">
      <div>
        <h2 class="font-semibold text-xl text-gray-600">Оборудование</h2>
        <p class="text-gray-500 mb-6">Форма добавления записей.</p>

        <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
          <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
            <div class="text-gray-600">
              <p class="font-medium text-lg">Детали</p>
              <p>Пожалуйста заполните поля.</p>
            </div>

            <div class="lg:col-span-2">
              <div class="grid gap-4 gap-y-6 text-sm grid-cols-1 md:grid-cols-5">

                <div class="md:col-span-5">
                  <label for="equipment-type" class="mb-1">Тип оборудования</label>
                  <div :class="['relative', {'border border-red-500': errors && errors.equipment_type_id}]">
                    <SearchSelect
                        id="equipment-type"
                        v-model="activeSearchSelectItem"
                        :options="searchSelectItems"
                        @input="$event => searchSelectCurrentValue = $event.target.value"
                        placeholder="Выберите тип оборудования"
                    />
                    <div class="absolute text-red-500 top-[110%] left-0" v-if="errors && errors.equipment_type_id">
                      {{errors.equipment_type_id[0]}}
                    </div>
                  </div>
                </div>

                <div class="md:col-span-5 relative">
                  <label for="serialNumber">Серийные номера (через запятую)</label>
                  <textarea
                      id="serialNumber"
                      :class="['border mt-1 outline-none rounded px-4 w-full bg-gray-50 py-2', {'border border-red-500': errors && errors.equipments}]"
                      rows="5"
                      placeholder="XXXXXXXXXX,XXXXXXXAX"
                      v-model="equipments"
                  />
                  <div class="absolute text-red-500 top-[100%] left-0" v-if="errors && errors.equipments">
                    {{errors.equipments[0]}}
                  </div>
                </div>

                <div class="md:col-span-5 relative">
                  <label for="desc">Примечание</label>
                  <textarea
                      type="text"
                      id="desc"
                      :class="['border mt-1 outline-none rounded px-4 w-full bg-gray-50 py-2', {'border border-red-500': errors && errors.desc}]"
                      placeholder="Введите примечание"
                      rows="5"
                      v-model="desc"
                  />
                  <div class="absolute text-red-500 top-[110%] left-0" v-if="errors && errors.desc">
                    {{errors.desc[0]}}
                  </div>
                </div>

                <div class="md:col-span-5 text-right">
                  <div class="inline-flex items-end">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        @click="handleSubmit"
                    >Создать</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <template>
    <TransitionRoot as="template" :show="open">
      <Dialog as="div" class="relative z-10" @close="handleCloseResponseModal">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
          <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
        </TransitionChild>

        <div class="fixed inset-0 z-10 overflow-y-auto">
          <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
              <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                  <div class="sm:flex sm:items-start" v-if="responseInfo.errors && responseInfo.errors.length">
                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                      <ExclamationTriangleIcon class="h-6 w-6 text-red-600" aria-hidden="true" />
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                      <DialogTitle as="h3" class="text-base font-semibold leading-6 text-gray-900">Errors</DialogTitle>
                      <div class="mt-2" v-for="key in Object.keys(responseInfo.errors)">
                        <p class="text-sm text-gray-500">{{key}} - {{ responseInfo.errors[key] }}</p>
                      </div>
                    </div>
                  </div >

                  <div class="sm:flex sm:items-start" v-if="responseInfo.success && responseInfo.success.length">
                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                      <CheckIcon class="h-6 w-6 text-green-600" aria-hidden="true" />
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                      <DialogTitle as="h3" class="text-base font-semibold leading-6 text-gray-900">Success</DialogTitle>
                      <div class="mt-2" v-for="key in Object.keys(responseInfo.success)">
                        <p class="text-sm text-gray-500">{{key}} - {{ responseInfo.success[key] }}</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                  <button
                      type="button"
                      class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto"
                      @click="handleCloseResponseModal"
                  >Close</button>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </template>
</template>

<script>
import {ModelSelect as SearchSelect} from 'vue-search-select'
import "vue-search-select/dist/VueSearchSelect.css"
import {debounce} from "../../utils/debounce.js";
import {ApiInstance} from "../../utils/instance.js";
import router from "../../router/index.js";
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ExclamationTriangleIcon, CheckIcon } from '@heroicons/vue/24/outline'
export default {
  name: "Create",
  components: {
      SearchSelect,
      Dialog,
      ExclamationTriangleIcon,
      DialogPanel,
      DialogTitle,
      TransitionChild,
      TransitionRoot,
      CheckIcon
  },
  data () {
    return {
      responseInfo: {
        errors: null,
        success: null,
      },
      open: false,
      errors: null,
      desc: "",
      equipments: "",
      searchSelectItems: [],
      activeSearchSelectItem: {
        text: null,
        value: null
      },
      searchSelectCurrentValue: null
    }
  },
  methods: {
    async handleCloseResponseModal() {
      this.responseInfo = {
        errors: null,
        success: null
      }
      this.open = false
    },
    validateTypeId(typeId) {
      if (! typeId) return {'equipment_type_id': ['Необходимо указать тип']}
      return null
    },
    validateEquipmentNumbers(serialNumbers) {
      if (! serialNumbers) return {'equipments': ['Необходимо указать серийные номера']}
      return null
    },
    validateDesc(desc) {
      if (! desc) return {'desc': ['Необходимо указать пояснение']}
      return null
    },
    validateCreateEquipmentForm() {
      const formElements = [
        this.validateTypeId(this.activeSearchSelectItem.value),
        this.validateEquipmentNumbers(this.equipments),
        this.validateDesc(this.desc)
      ]
      const resultErrors = {}
      const keys = formElements.keys()
      for (const key of keys) {
        if (formElements[key]) {
          Object.assign(resultErrors, resultErrors[key], formElements[key])
        }
      }
      return resultErrors
    },
    async fetchEquipmentTypes(q = null) {
      const {data} = await ApiInstance.get('/equipment-type', {
        params: {
          q: q
        }
      })
      return data.data
    },
    async fetchOptions(q = null) {
      const data = await this.fetchEquipmentTypes(q)
      this.setSearchSelectOptionsByPaginatedData('searchSelectItems', data)
    },
    setSearchSelectOptionsByPaginatedData(optionsDataTitle, paginatedData) {
      if (paginatedData && paginatedData.length) {
        this[optionsDataTitle] = paginatedData
            .map(element => ({
              text: element.name + " - " + element.mask,
              value: element.id,
            }))
      } else {
        this[optionsDataTitle] = []
      }
    },
    async handleSubmit() {
      const fields = ['equipment_type_id', 'serial_number', 'desc']
      const body = {
        equipments: this.equipments.split(',').map(number => ({
          [fields[0]]: this.activeSearchSelectItem.value,
          [fields[1]]: number,
          [fields[2]]: this.desc,
        }))
      }
      const validateFormData = this.validateCreateEquipmentForm()
      if (validateFormData && typeof validateFormData === 'object' && Object.keys(validateFormData).length) {
        return this.errors = validateFormData
      }

      try {
        const {data} = await ApiInstance.post('/equipment', body)
        this.responseInfo = data
        this.open = true
      } catch (e) {
        if (e.response.status === 422) {
          const errors = e.response.data.errors
          const errorsArrayKeys = Object.keys(errors)
          const resultErrors = {}
          for (const field of fields) {
            const candidate = errorsArrayKeys.find(key => key.includes('.' + field))
            if (candidate) {
              Object.assign(resultErrors, {[field]: errors[candidate]})
            }
          }
          this.open = true
          return this.responseInfo.errors = resultErrors
        }
        alert(e?.message ?? e)
      }
    }
  },
  watch: {
    searchSelectCurrentValue(q) {
      const vm = this
      debounce(vm.fetchOptions(q), 300)
    }
  },
  created() {
    this.fetchOptions()
  }
}
</script>

<style scoped>

</style>