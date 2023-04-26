/**
 * External dependencies
 */
import React from 'react';
import { render, screen } from '@testing-library/react';
import user from '@testing-library/user-event';

/**
 * Internal dependencies
 */
import ModeChoice from '../mode-choice';
import strings from '../../strings';

let nextStep = jest.fn();

jest.mock( 'components/stepper', () => ( {
	useStepperContext: jest.fn( () => ( {
		nextStep,
	} ) ),
} ) );

declare const global: {
	wcpaySettings: {
		connectUrl: string;
	};
};

describe( 'ModeChoice', () => {
	it( 'displays test and live radio cards', () => {
		render( <ModeChoice /> );

		expect(
			screen.getByText( strings.steps.mode.live.label )
		).toBeInTheDocument();
		expect(
			screen.getByText( strings.steps.mode.test.label )
		).toBeInTheDocument();
	} );

	it( 'calls nextStep by clicking continue when `live` is selected', () => {
		nextStep = jest.fn();
		render( <ModeChoice /> );

		user.click( screen.getByText( strings.steps.mode.live.label ) );
		user.click( screen.getByRole( 'button' ) );

		expect( nextStep ).toHaveBeenCalled();
	} );

	it( 'redirects to `connectUrl` with `test_mode` enabled by clicking continue button when `test` is selected', () => {
		global.wcpaySettings = {
			connectUrl: 'https://wcpay.test/connect',
		};
		Object.defineProperty( window, 'location', {
			configurable: true,
			enumerable: true,
			value: new URL( window.location.href ),
		} );

		render( <ModeChoice /> );

		user.click( screen.getByText( strings.steps.mode.test.label ) );
		user.click( screen.getByRole( 'button' ) );

		expect( window.location.href ).toBe(
			`https://wcpay.test/connect?test_mode=true`
		);
	} );
} );
