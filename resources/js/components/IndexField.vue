<template>
  <div class="flex text-gray-400">
    <button @click.stop="reorderResource('up')" class="toolbar-button px-2" :class="{ invisible: canNotSortUp }" :aria-label="this.__('Up')" type="button">
      <Icon type="chevron-up"/>
    </button>
    <button @click.stop="reorderResource('down')" class="toolbar-button px-2" :class="{ invisible: canNotSortDown }" :aria-label="this.__('Down')" type="button">
      <Icon type="chevron-down"/>
    </button>
  </div>
</template>

<script>
export default {
  props: ['resource', 'resourceName', 'field'],

  methods: {
    async reorderResource(direction) {
      try {
        await this.reorderRequest(direction);
        await this.refreshResourcesList()
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
  },

  computed: {
    resourceTableRow() {
      return this.$parent;
    },
    resourceTable() {
      return this.resourceTableRow.$parent;
    },
    index() {
      return this.resourceTable.$parent.$parent.$parent.$parent;
    },
    resources() {
      return this.resourceTable.resources;
    },
    hasNextPage() {
      return this.index.hasNextPage;
    },
    isFirstItem() {
      return this.resource.id.value === this.resources[0].id.value;
    },
    isLastItem() {
      return this.resource.id.value === this.resources[this.resources.length - 1].id.value;
    },
    hasPreviousPage() {
      return this.index.hasPreviousPage;
    },
    canNotSortUp() {
      return (this.isFirstItem && !this.hasPreviousPage);
    },
    canNotSortDown() {
      return (this.isLastItem && !this.hasNextPage);
    },
  }
}
</script>
