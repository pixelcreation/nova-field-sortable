<template>
  <div class="nova-field-sortable flex items-center space-x-0 items-center text-gray-400">
    <button @click.stop="reorderResource('up')" class="flex items-center justify-center px-2 w-8 h-8 rounded-full" aria-label="{{ __('Up') }}" type="button">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
        <path d="M13 5.41V21a1 1 0 0 1-2 0V5.41l-5.3 5.3a1 1 0 1 1-1.4-1.42l7-7a1 1 0 0 1 1.4 0l7 7a1 1 0 1 1-1.4 1.42L13 5.4z"/>
      </svg>
    </button>
    <button @click.stop="reorderResource('down')" class="flex items-center justify-center px-2 w-8 h-8 rounded-full" aria-label="{{ __('Up') }}" type="button">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
        <path d="M11 18.59V3a1 1 0 0 1 2 0v15.59l5.3-5.3a1 1 0 0 1 1.4 1.42l-7 7a1 1 0 0 1-1.4 0l-7-7a1 1 0 0 1 1.4-1.42l5.3 5.3z"/>
      </svg>
    </button>
  </div>
</template>

<script>
export default {
  props: ['resourceName', 'resource', 'field'],
  methods: {
    async reorderResource(direction) {
      try {
        await this.reorderRequest(direction);
        await this.refreshResourcesList()
        Nova.success(this.__('The new order has been set!'));
      } catch (_) {
        Nova.error(
          this.__('An error occurred while trying to reorder the resource.'),
        );
      }
    },

    reorderRequest(direction) {
      return Nova.request().patch(
        `/nova-vendor/pixelcreation/nova-field-sortable/${this.resourceName}/${this.resource.id.value}/reorder`,
        {direction: direction}
      );
    },

    async refreshResourcesList() {
      // Might break with new Laravel Nova versions
      let parent = this.$parent;
      while (parent && !parent.getResources) {
        parent = parent.$parent;
      }
      if (parent && parent.getResources) await parent.getResources();
    },
  }
}
</script>

<style>
  .nova-field-sortable button:hover {
     background-color: rgba(139, 131, 131, 0.10);
  }
</style>
