<template lang="pug">
  input( v-model="displayValue"
         @blur="handleInputState"
         @focus="handleInputState" )
</template>

<script>

const masks = {
  currency: {
    mask (value) {
      return '$' + (value !== null ? value.toLocaleString() : ''.toLocaleString())
    },
    unmask (value) {
      value = parseFloat(value.replace(/[^\d\.]/g, ""))
      return isNaN(value) ? 0 : value
    },
  },
}

export default {
  props: {
    value: null,
    maskType: String,
    focused: false
  },
  data: function() {
    return {
      inputFocused: false
    }
  },
  watch: {
    focused (value) {
      this.inputFocused = value
    }
  },
  methods: {
    handleInputState (event) {
      this.inputFocused = event.type === 'focus'
    },
    unmask (value) {
      return masks[this.maskType].unmask(value)
    },
    mask (value) {
      return masks[this.maskType].mask(value)
    },
  },
  computed: {
    displayValue: {
      get: function() {
        if (this.inputFocused) {
          return (this.value !== null ? this.value.toLocaleString() : ''.toLocaleString())
        } else {
          return this.mask(this.value)
        }
      },
      set: function(modifiedValue) {        
        this.$emit('input', this.unmask(modifiedValue))
      }
    }
  }
}
</script>

<style lang="stylus" scope>
</style>
