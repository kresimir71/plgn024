// tweakStructure.js

/**
 * Updates a second-level nested field within an object structure.
 * 
 * @param {Object} obj - The original state object.
 * @param {string} level1 - The first-level property key.
 * @param {string} level2 - The second-level property key within level1.
 * @param {*} newValue - The new value to set for the nested field.
 * @returns {Object} - A new state object with the updated nested field.
 */
export const tweakStructureLevel2 = (obj, level1, level2, newValue) => {
  return {
    ...obj,
    [level1]: {
      ...obj[level1],
      [level2]: newValue
    }
  };
};

/**
 * Updates a third-level nested field within an object structure.
 * 
 * @param {Object} obj - The original state object.
 * @param {string} level1 - The first-level property key.
 * @param {string} level2 - The second-level property key within level1.
 * @param {string} level3 - The third-level property key within level2.
 * @param {*} newValue - The new value to set for the nested field.
 * @returns {Object} - A new state object with the updated nested field.
 */
export const tweakStructureLevel3 = (obj, level1, level2, level3, newValue) => {
  return {
    ...obj,
    [level1]: {
      ...obj[level1],
      [level2]: {
        ...obj[level1][level2],
        [level3]: newValue
      }
    }
  };
};

/**
 * Updates a fourth-level nested field within an object structure.
 * 
 * @param {Object} obj - The original state object.
 * @param {string} level1 - The first-level property key.
 * @param {string} level2 - The second-level property key within level1.
 * @param {string} level3 - The third-level property key within level2.
 * @param {string} level4 - The fourth-level property key within level3.
 * @param {*} newValue - The new value to set for the nested field.
 * @returns {Object} - A new state object with the updated nested field.
 */
export const tweakStructureLevel4 = (obj, level1, level2, level3, level4, newValue) => {
  return {
    ...obj,
    [level1]: {
      ...obj[level1],
      [level2]: {
        ...obj[level1][level2],
        [level3]: {
          ...obj[level1][level2][level3],
          [level4]: newValue
        }
      }
    }
  };
};