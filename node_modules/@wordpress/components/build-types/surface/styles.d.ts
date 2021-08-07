/**
 * @param {Object}  props
 * @param {boolean} [props.borderBottom]
 * @param {boolean} [props.borderLeft]
 * @param {boolean} [props.borderRight]
 * @param {boolean} [props.borderTop]
 */
export function getBorders({ borderBottom, borderLeft, borderRight, borderTop, }: {
    borderBottom: boolean | undefined;
    borderLeft: boolean | undefined;
    borderRight: boolean | undefined;
    borderTop: boolean | undefined;
}): string;
export const Surface: string;
export const background: string;
export const primary: string;
export const secondary: string;
export const tertiary: string;
export function getDotted(surfaceBackgroundSize: string, surfaceBackgroundSizeDotted: string): string;
export function getGrid(surfaceBackgroundSize: string): string;
export function getVariant(variant: 'dotted' | 'grid' | 'primary' | 'secondary' | 'tertiary', surfaceBackgroundSize: string, surfaceBackgroundSizeDotted: string): string;
//# sourceMappingURL=styles.d.ts.map