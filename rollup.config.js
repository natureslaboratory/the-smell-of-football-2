import resolve from '@rollup/plugin-node-resolve'
import babel from '@rollup/plugin-babel'
import typescript from '@rollup/plugin-typescript'
import rollupJson from 'rollup-plugin-json'
import commonjs from 'rollup-plugin-commonjs'

export default {
    input: 'src/index.ts',
    output: {
        file: 'assets/js/index.js',
        format: 'iife'
    },
    plugins: [
        resolve({ jsnext: true, preferBuiltins: true, browser: true }),
        typescript(),
        babel({ babelHelpers: 'bundled' }),
        rollupJson(),
        commonjs({
            include: ['node_modules/**']
        })
    ],
    watch: {
        buildDelay: 10
    }
}